<?php

use App\Models\Branch;
use App\Models\Property;
use App\Models\TenantUnitLink;
use App\Models\UtilityAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/pricing', 'pricing')->name('pricing');

Route::middleware('guest')->group(function (): void {
    Route::view('/admin/login', 'admin.login')->name('admin.login');

    Route::post('/admin/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    })->name('admin.login.submit');
});

Route::middleware('auth')->group(function (): void {
    $defaultSettings = [
        'plan_name' => 'Business Plan',
        'billed_plan' => 'Business Plan',
        'plan_status' => 'Active',
        'plan_amount' => 'KES 9,500 / month',
        'valid_until' => '2026-12-17',
        'public_subdomain' => 'youragency',
        'public_theme' => 'Default',
        'require_login_code' => false,
        'auto_generate_invoices' => true,
        'hide_brought_forward' => false,
        'auto_close_pending' => true,
        'collections_grace_days' => 0,
        'collections_upcoming_due' => '5,3,1',
        'collections_overdue' => '1,3,7,14,30',
        'collections_auto_escalate' => 60,
    ];

    $buildDashboardPayload = function (Request $request, bool $applyPropertySearch = false) use ($defaultSettings): array {
        $allProperties = Property::query()->latest()->get();
        $properties = $allProperties;

        if ($applyPropertySearch && $request->filled('q')) {
            $term = (string) $request->input('q');
            $properties = Property::query()
                ->latest()
                ->where(function ($query) use ($term): void {
                    $query->where('name', 'like', "%{$term}%")
                        ->orWhere('location', 'like', "%{$term}%")
                        ->orWhere('property_type', 'like', "%{$term}%");
                })
                ->get();
        }

        $branches = Branch::query()->latest()->get();
        $utilityAccounts = UtilityAccount::query()->latest()->get();
        $tenantLinks = TenantUnitLink::query()->latest()->get();

        $tenantLinksByProperty = $tenantLinks
            ->filter(fn ($link) => $link->property_id !== null)
            ->groupBy('property_id')
            ->map(function ($links) {
                return $links
                    ->map(fn ($link) => trim((string) $link->unit_number))
                    ->filter()
                    ->unique()
                    ->values();
            });

        $formatLabel = static function (?string $value, string $fallback = 'N/A'): string {
            if (! $value) {
                return $fallback;
            }

            return ucwords(str_replace('_', ' ', $value));
        };

        $portfolioProperties = $allProperties->values()->map(function (Property $property, int $index) use ($tenantLinksByProperty, $formatLabel): array {
            $occupiedLabels = $tenantLinksByProperty->get($property->id, collect());
            $occupiedUnits = $occupiedLabels->count();
            $totalUnits = max((int) ($property->units_count ?? 0), $occupiedUnits);
            $vacantUnits = max($totalUnits - $occupiedUnits, 0);
            $occupancyRate = $totalUnits > 0 ? (int) round(($occupiedUnits / $totalUnits) * 100) : 0;

            return [
                'id' => $property->id,
                'name' => $property->name,
                'type_label' => $formatLabel($property->property_type, 'Portfolio asset'),
                'branch_label' => $formatLabel($property->branch, 'Main branch'),
                'location' => $property->location ?: 'Location not set',
                'total_units' => $totalUnits,
                'occupied_units' => $occupiedUnits,
                'vacant_units' => $vacantUnits,
                'occupancy_rate' => $occupancyRate,
                'occupied_labels' => $occupiedLabels->take(6)->all(),
                'public_listing' => $index % 2 === 0 ? 'listed' : 'hidden',
            ];
        });

        $occupiedUnits = (int) $portfolioProperties->sum('occupied_units');
        $vacantUnits = (int) $portfolioProperties->sum('vacant_units');
        $totalUnits = (int) $portfolioProperties->sum('total_units');
        $listedPublicly = (int) $portfolioProperties->where('public_listing', 'listed')->count();
        $hiddenInternally = (int) $portfolioProperties->where('public_listing', 'hidden')->count();
        $inactiveLeases = (int) $allProperties->where('status', '!=', 'active')->count();

        $leasesByStatus = [
            'occupied' => $occupiedUnits,
            'vacated' => $vacantUnits,
            'pending' => 0,
            'pending_move_out' => 0,
            'inactive' => $inactiveLeases,
        ];

        $settingsData = array_merge(
            $defaultSettings,
            (array) $request->session()->get('dashboard_settings', [])
        );

        return [
            'properties' => $properties,
            'propertyTotal' => $allProperties->count(),
            'branches' => $branches,
            'utilityAccounts' => $utilityAccounts,
            'tenantLinks' => $tenantLinks,
            'portfolioProperties' => $portfolioProperties,
            'totalUnits' => $totalUnits,
            'occupiedUnits' => $occupiedUnits,
            'vacantUnits' => $vacantUnits,
            'occupiedProperties' => (int) $portfolioProperties->where('occupied_units', '>', 0)->count(),
            'vacantProperties' => (int) $portfolioProperties->where('vacant_units', '>', 0)->count(),
            'listedPublicly' => $listedPublicly,
            'hiddenInternally' => $hiddenInternally,
            'freshUpdates' => max($vacantUnits, $portfolioProperties->count()),
            'pendingApprovalsTotal' => 0,
            'leasesByStatus' => $leasesByStatus,
            'leasesTotal' => array_sum($leasesByStatus),
            'settingsData' => $settingsData,
        ];
    };

    Route::get('/admin/properties', function (Request $request) use ($buildDashboardPayload) {
        $allowedActions = ['new-property', 'import-data', 'link-tenant', 'branches', 'utility-accounts'];
        $action = $request->input('action');
        if (! in_array($action, $allowedActions, true)) {
            $action = null;
        }
        $payload = $buildDashboardPayload($request, true);

        return view('admin.dashboard', array_merge($payload, [
            'section' => 'properties',
            'activeAction' => $action,
        ]));
    })->name('admin.properties');

    Route::post('/admin/properties', function (Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'landlord_assignment' => ['required', 'in:use_my_business,landlord_1,landlord_2'],
            'agent_assignment' => ['required', 'in:no_agent,agent_1,agent_2'],
            'branch' => ['nullable', 'in:no_branch,westlands,kilimani,karen'],
            'property_type' => ['required', 'in:apartment,bedsitter,mixed_use,commercial,maisonette'],
            'units_count' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'location' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'paybill_number' => ['nullable', 'digits_between:4,20'],
            'account_format' => ['required', 'in:unit_number,tenant_name,manual_reference'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'service_charge' => ['required', 'numeric', 'min:0', 'max:100'],
            'income_tax' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('properties', 'public');
        }

        Property::create($validated);

        return redirect()
            ->route('admin.properties')
            ->with('status', 'Property saved successfully.');
    })->name('admin.properties.store');

    Route::post('/admin/properties/import-data', function (Request $request) {
        $request->validate([
            'import_file' => ['required', 'file', 'mimes:csv,txt,xlsx,xls', 'max:5120'],
        ]);

        $request->file('import_file')->store('property-imports', 'public');

        return redirect()
            ->route('admin.properties', ['action' => 'import-data'])
            ->with('status', 'Property data file uploaded successfully.');
    })->name('admin.properties.import');

    Route::post('/admin/properties/link-tenant', function (Request $request) {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'tenant_name' => ['required', 'string', 'max:255'],
            'unit_number' => ['required', 'string', 'max:100'],
        ]);

        TenantUnitLink::create($validated);

        return redirect()
            ->route('admin.properties', ['action' => 'link-tenant'])
            ->with('status', 'Tenant linked to unit successfully.');
    })->name('admin.properties.link-tenant');

    Route::post('/admin/properties/branches', function (Request $request) {
        $validated = $request->validate([
            'branch_name' => ['required', 'string', 'max:255'],
            'branch_location' => ['nullable', 'string', 'max:255'],
        ]);

        Branch::create([
            'name' => $validated['branch_name'],
            'location' => $validated['branch_location'] ?? null,
        ]);

        return redirect()
            ->route('admin.properties', ['action' => 'branches'])
            ->with('status', 'Branch saved successfully.');
    })->name('admin.properties.branches.store');

    Route::post('/admin/properties/utility-accounts', function (Request $request) {
        $validated = $request->validate([
            'property_id' => ['nullable', 'exists:properties,id'],
            'provider' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],
            'utility_paybill' => ['nullable', 'digits_between:4,20'],
        ]);

        UtilityAccount::create([
            'property_id' => $validated['property_id'] ?? null,
            'provider' => $validated['provider'],
            'account_number' => $validated['account_number'],
            'paybill_number' => $validated['utility_paybill'] ?? null,
        ]);

        return redirect()
            ->route('admin.properties', ['action' => 'utility-accounts'])
            ->with('status', 'Utility account saved successfully.');
    })->name('admin.properties.utility-accounts.store');

    Route::post('/admin/settings', function (Request $request) use ($defaultSettings) {
        $currentSettings = array_merge(
            $defaultSettings,
            (array) $request->session()->get('dashboard_settings', [])
        );

        $formKey = (string) $request->input('form_key');
        $updatedSettings = $currentSettings;

        if ($formKey === 'public-site') {
            $validated = $request->validate([
                'public_subdomain' => ['required', 'string', 'max:80', 'regex:/^[a-z0-9-]+$/'],
                'public_theme' => ['required', 'string', 'in:Default,Ocean,Forest,Slate'],
            ]);

            $updatedSettings['public_subdomain'] = strtolower($validated['public_subdomain']);
            $updatedSettings['public_theme'] = $validated['public_theme'];
        } elseif ($formKey === 'two-factor') {
            $updatedSettings['require_login_code'] = $request->boolean('require_login_code');
        } elseif ($formKey === 'invoice-generation') {
            $updatedSettings['auto_generate_invoices'] = $request->boolean('auto_generate_invoices');
        } elseif ($formKey === 'invoice-pdf') {
            $updatedSettings['hide_brought_forward'] = $request->boolean('hide_brought_forward');
        } elseif ($formKey === 'close-zero-balance') {
            $updatedSettings['auto_close_pending'] = $request->boolean('auto_close_pending');
        } elseif ($formKey === 'collections-reminders') {
            $validated = $request->validate([
                'collections_grace_days' => ['required', 'integer', 'min:0', 'max:365'],
                'collections_upcoming_due' => ['required', 'string', 'max:255'],
                'collections_overdue' => ['required', 'string', 'max:255'],
                'collections_auto_escalate' => ['required', 'integer', 'min:0', 'max:365'],
            ]);

            $updatedSettings['collections_grace_days'] = (int) $validated['collections_grace_days'];
            $updatedSettings['collections_upcoming_due'] = $validated['collections_upcoming_due'];
            $updatedSettings['collections_overdue'] = $validated['collections_overdue'];
            $updatedSettings['collections_auto_escalate'] = (int) $validated['collections_auto_escalate'];
        } else {
            return redirect()
                ->route('admin.settings')
                ->with('settings_error', 'Unknown settings action.');
        }

        $request->session()->put('dashboard_settings', $updatedSettings);

        return redirect()
            ->route('admin.settings')
            ->with('settings_status', 'Settings updated successfully.');
    })->name('admin.settings.save');

    $panelRoutes = [
        ['uri' => 'dashboard', 'name' => 'dashboard', 'section' => 'dashboard'],
        ['uri' => 'reports', 'name' => 'reports', 'section' => 'reports'],
        ['uri' => 'approvals', 'name' => 'approvals', 'section' => 'approvals'],
        ['uri' => 'units', 'name' => 'units', 'section' => 'units'],
        ['uri' => 'vacant-units', 'name' => 'vacant-units', 'section' => 'vacant-units'],
        ['uri' => 'tenants', 'name' => 'tenants', 'section' => 'tenants'],
        ['uri' => 'leases', 'name' => 'leases', 'section' => 'leases'],
        ['uri' => 'bookings', 'name' => 'bookings', 'section' => 'bookings'],
        ['uri' => 'invoices', 'name' => 'invoices', 'section' => 'invoices'],
        ['uri' => 'collections', 'name' => 'collections', 'section' => 'collections'],
        ['uri' => 'utility-readings', 'name' => 'utility-readings', 'section' => 'utility-readings'],
        ['uri' => 'accounting', 'name' => 'accounting', 'section' => 'accounting'],
        ['uri' => 'expenses', 'name' => 'expenses', 'section' => 'expenses'],
        ['uri' => 'leads', 'name' => 'leads', 'section' => 'leads'],
        ['uri' => 'lead-pipeline', 'name' => 'lead-pipeline', 'section' => 'lead-pipeline'],
        ['uri' => 'cases', 'name' => 'cases', 'section' => 'cases'],
        ['uri' => 'security-logbook', 'name' => 'security-logbook', 'section' => 'security-logbook'],
        ['uri' => 'tickets', 'name' => 'tickets', 'section' => 'tickets'],
        ['uri' => 'documents', 'name' => 'documents', 'section' => 'documents'],
        ['uri' => 'audit-logs', 'name' => 'audit-logs', 'section' => 'audit-logs'],
        ['uri' => 'teams', 'name' => 'teams', 'section' => 'teams'],
        ['uri' => 'departments', 'name' => 'departments', 'section' => 'departments'],
        ['uri' => 'commissions', 'name' => 'commissions', 'section' => 'commissions'],
        ['uri' => 'commission-payouts', 'name' => 'commission-payouts', 'section' => 'commission-payouts'],
        ['uri' => 'users', 'name' => 'users', 'section' => 'users'],
        ['uri' => 'settings', 'name' => 'settings', 'section' => 'settings'],
        ['uri' => 'billing-invoices', 'name' => 'billing-invoices', 'section' => 'billing-invoices'],
    ];

    foreach ($panelRoutes as $panelRoute) {
        Route::get('/admin/'.$panelRoute['uri'], function (Request $request) use ($panelRoute, $buildDashboardPayload) {
            return view('admin.dashboard', array_merge($buildDashboardPayload($request), [
                'section' => $panelRoute['section'],
            ]));
        })->name('admin.'.$panelRoute['name']);
    }

    Route::post('/admin/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('admin.logout');
});

<?php

use App\Livewire\Meals\Create;
use App\Livewire\Meals\Index as MealsIndex;
use App\Livewire\Meals\Update;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Stores\Index as IndexStore;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('meals', MealsIndex::class)->name('meals.index');
    Route::get('meals/create', Create::class)->name('meals.create');
    Route::get('meals/{meal}', Update::class)->name('meals.update');

    Route::get('stores/', IndexStore::class)->name('stores.index');
    Route::get('stores/create', Update::class)->name('stores.create');
    Route::get('stores/{meal}', Update::class)->name('stores.update');

});

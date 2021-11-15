<?php

namespace App\Http\Controllers;

use App\Page;
use App\Country;
use App\Location;
use App\Language;
use App\SmsSetting;
use App\ThemeSetting;
use App\FooterSetting;
use App\Helper\Formats;
use App\CompanySetting;
use App\FrontThemeSetting;
use Illuminate\Support\Arr;
use App\GoogleCaptchaSetting;
use App\SocialAuthSetting;
use Froiden\Envato\Traits\AppBoot;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AppBoot;
    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public $user;
    public $pageTitle;
    public $settings;
    public $productsCount;

    public function __construct()
    {
        $this->showInstall();
        $this->checkMigrateStatus();
        $this->settings = CompanySetting::first();
        $this->smsSettings = SmsSetting::first();

        config(['app.name' => $this->settings->address]);
        config(['app.url' => url('/')]);

        $this->pages = Page::all();
        $this->countries = Country::all();
        $this->name = Route::currentRouteName();
        $this->themeSettings = ThemeSetting::first();
        $this->footerSetting = FooterSetting::first();
        $this->socialAuthSettings = SocialAuthSetting::first();
        $this->frontThemeSettings = FrontThemeSetting::first();
        $this->locations = Location::select('id', 'name')->get();
        $this->googleCaptchaSettings = GoogleCaptchaSetting::first();
        $this->languages = Language::where('status', 'enabled')->orderBy('language_name', 'asc')->get();

        view()->share('name', $this->name);
        view()->share('pages', $this->pages);
        view()->share('settings', $this->settings);
        view()->share('countries', $this->countries);
        view()->share('languages', $this->languages);
        view()->share('locations', $this->locations);
        view()->share('smsSettings', $this->smsSettings);
        view()->share('footerSetting', $this->footerSetting);
        view()->share('themeSettings', $this->themeSettings);
        view()->share('calling_codes', $this->getCallingCodes());
        view()->share('frontThemeSettings', $this->frontThemeSettings);
        view()->share('socialAuthSettings', $this->socialAuthSettings);
        view()->share('googleCaptchaSettings', $this->googleCaptchaSettings);
        view()->share('date_format', Formats::datePickerFormats()[$this->settings->date_format]);
        view()->share('time_picker_format', Formats::timeFormats()[$this->settings->time_format]);
        view()->share('date_picker_format', Formats::dateFormats()[$this->settings->date_format]);

        $this->middleware('auth')->only(['paymentGateway', 'offlinePayment', 'paymentConfirmation']);

        $this->middleware(function ($request, $next) {
            $this->productsCount = request()->hasCookie('products') ? count(json_decode(request()->cookie('products'), true)) : 0;
            $this->user = auth()->user();

            if ($this->user) {
                $this->todoItems = $this->user->todoItems()->groupBy('status', 'position')->get();
                config(['froiden_envato.allow_users_id' => true]);
            }

            view()->share('user', $this->user);
            view()->share('productsCount', $this->productsCount);

            App::setLocale($this->settings->locale);
            // config(['app.timezone' => $this->settings->timezone]);
            // Carbon::setLocale($this->settings->locale);
            // setlocale(LC_TIME, $this->settings->locale . '_' . strtoupper($this->settings->locale));

            return $next($request);
        });
    }

    public function checkMigrateStatus()
    {
        $status = Artisan::call('migrate:check');

        if ($status) {
            Artisan::call('migrate', array('--force' => true)); // Migrate database
        }
    }

    public function getCallingCodes()
    {
        $codes = [];

        foreach(config('calling_codes.codes') as $code) {
            $codes = Arr::add($codes, $code['code'], array('name' => $code['name'], 'dial_code' => $code['dial_code']));
        };
        
        return $codes;
    }

    public function generateTodoView()
    {
        $pendingTodos = $this->user->todoItems()->status('pending')->orderBy('position', 'DESC')->limit(5)->get();
        $completedTodos = $this->user->todoItems()->status('completed')->orderBy('position', 'DESC')->limit(5)->get();
        $dateFormat = $this->settings->date_format;

        $view = view('partials.todo_items_list', compact('pendingTodos', 'completedTodos', 'dateFormat'))->render();

        return $view;
    }

}

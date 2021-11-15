<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Media;
use App\Module;
use App\Currency;
use App\Language;
use Carbon\Carbon;
use App\Permission;
use App\SmsSetting;
use App\BookingTime;
use App\OfficeLeave;
use App\SmtpSetting;
use App\Helper\Files;
use App\Helper\Reply;
use GuzzleHttp\Client;
use App\CompanySetting;
use App\Helper\Formats;
use App\SocialAuthSetting;
use App\BookingNotifaction;
use Illuminate\Http\Request;
use App\CurrencyFormatSetting;
use App\PaymentGatewayCredentials;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Setting\UpdateSetting;
use App\Http\Requests\Setting\BookingSetting;

class SettingController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        view()->share('pageTitle', __('menu.settings'));

    }

    public function index()
    {
        $this->bookingTimes = BookingTime::all();
        $this->images = Media::select('id', 'file_name')->latest()->get();
        $this->timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $this->dateFormats = Formats::dateFormats();
        $this->timeFormats = Formats::timeFormats();
        $this->dateObject = Carbon::now($this->settings->timezone);
        $this->currencies = Currency::all();
        $this->enabledLanguages = Language::where('status', 'enabled')->orderBy('language_name')->get();
        $this->smtpSetting = SmtpSetting::first();
        $this->credentialSetting = PaymentGatewayCredentials::first();
        $this->smsSetting = SmsSetting::first();
        $this->roles = Role::where('name', '<>', 'administrator')->get();
        $this->totalPermissions = Permission::count();
        $this->modules = Module::all();
        $this->socialCredentials = SocialAuthSetting::first();

        $client = new Client();
        $res = $client->request('GET', config('froiden_envato.updater_file_path'), ['verify' => false]);
        $this->lastVersion = $res->getBody();
        $this->lastVersion = json_decode($this->lastVersion, true);
        $currentVersion = File::get('version.txt');

        $description = $this->lastVersion['description'];

        $this->newUpdate = 0;

        if (version_compare($this->lastVersion['version'], $currentVersion) > 0)
        {
            $this->newUpdate = 1;
        }

        $this->updateInfo = $description;
        $this->lastVersion = $this->lastVersion['version'];

        $this->appVersion = File::get('version.txt');
        $laravel = app();
        $this->laravelVersion = $laravel::VERSION;
        $this->officeLeaves = OfficeLeave::all();
        $this->companyBookingNotifaction = BookingNotifaction::all();
        $this->currency_settings_formats = CurrencyFormatSetting::first();

        return view('admin.settings.index', $this->data);
    }

    // @codingStandardsIgnoreLine
    public function update(UpdateSetting $request, $id)
    {
        abort_if(!$this->user->roles()->withoutGlobalScopes()->first()->hasPermission('manage_settings'), 403);
        $setting = CompanySetting::first();
        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->company_phone = $request->company_phone;
        $setting->address = $request->address;
        $setting->date_format = $request->date_format;
        $setting->time_format = $request->time_format;
        $setting->website = $request->website;
        $setting->timezone = $request->timezone;
        $setting->locale = $request->input('locale');
        $setting->currency_id = $request->currency_id;

        if ($request->hasFile('logo')) {
            $setting->logo = Files::upload($request->logo, 'logo');
        }

        $setting->save();

        if ($setting->currency->currency_code !== 'INR') {
            $credential = PaymentGatewayCredentials::first();

            if ($credential->razorpay_status == 'active') {
                $credential->razorpay_status = 'deactive';

                $credential->save();
            }
        }

        cache()->forget('global_setting');

        return Reply::success(__('messages.updatedSuccessfully'));
    }

    public function changeLanguage($code)
    {
        $language = Language::where('language_code', $code)->first();

        if ($language) {
            $this->settings->locale = $code;
        }
        else if ($code == 'en') {
            $this->settings->locale = 'en';
        }

        $this->settings->save();

        return Reply::success(__('messages.languageChangedSuccessfully'));
    }

    public function saveBookingTimesField(BookingSetting $request)
    {
        $booking_per_day = is_null($request->no_of_booking_per_customer) ? 0 : $request->no_of_booking_per_customer;

        $setting = CompanySetting::first();

        $setting->booking_per_day    = $booking_per_day;
        $setting->multi_task_user    = $request->multi_task_user;
        $setting->employee_selection = $request->employee_selection;
        $setting->disable_slot       = $request->disable_slot;
        $setting->booking_time_type  = $request->booking_time_type;
        $setting->cron_status        = $request->cron_status;

        if (!$request->cron_status) {
            $setting->cron_status    = 'deactive';
        }

        $setting->duration           = $request->duration;
        $setting->duration_type      = $request->duration_type;
        $setting->save();

        if($request->disable_slot == 'enabled'){
            DB::table('payment_gateway_credentials')->where('id', 1)->update(['show_payment_options' => 'hide', 'offline_payment' => 1]);
        }

        return Reply::success(__('messages.updatedSuccessfully'));
    }

    public function saveGoogleCalendarConfig(Request $request)
    {
        $globalSetting = CompanySetting::first();

        if ($request->google_calendar) {
            $globalSetting->google_calendar = $request->google_calendar;
        }
        else {
            $globalSetting->google_calendar = 'deactive';
        }

        $globalSetting->google_client_id = $request->google_client_id;
        $globalSetting->google_client_secret = $request->google_client_secret;
        $globalSetting->save();

        return Reply::success(__('messages.updatedSuccessfully'));
    }

}

<?php

namespace App\Observers;

use App\BusinessService;
use App\Helper\SearchLog;
use Illuminate\Support\Facades\File;

class BusinessServiceObserver
{

    public function created(BusinessService $service)
    {
        SearchLog::createSearchEntry($service->id, 'Service', $service->name, 'admin.business-services.edit');

    }

    public function updating(BusinessService $service)
    {
        SearchLog::updateSearchEntry($service->id, 'Service', $service->name, 'admin.business-services.edit');
    }

    public function deleted(BusinessService $service)
    {
        SearchLog::deleteSearchEntry($service->id, 'admin.business-services.edit');

        // Delete images folder from user-uploads/service directory
        File::deleteDirectory(public_path('user-uploads/service/'.$service->id));
    }

}

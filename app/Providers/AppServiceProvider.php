<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SubjectHelper;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            $query = SubjectHelper::getSubjectList();
            foreach ($query as $val) {
                $getDetails = SubjectHelper::getParentList($val->id);
                if(count($getDetails)>0){
                    foreach($getDetails as $subcate){
                        $subcate->sub_caregory_url = URL::to('/') . '/sub-subject/' . sha1($subcate->id);
                    }
                }else{
                    $val->caregory_url = URL::to('/').'/subject/'.sha1($val->id);
                }
                $val->subcategory = $getDetails;
            }
            $data['response_menu'] = $query;
            $view->with($data);
        });
        
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

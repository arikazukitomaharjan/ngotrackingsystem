<?php
    namespace app\Http\ViewComposer;

    use App\WorkingZone;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Facades\Auth;

    class ShowDistrict
    {

        /*
         * The menu repository implementation.
         *
         * @var MenuRepository
         */
        protected $district;





        public function __construct(WorkingZone $district)
        {

            $this->district = $district;
        }





        /*
         * Bind data to the view.
         *
         * @param  View  $view
         * @return void
         */
        public function compose(View $view)
        {

            if (Auth::user()) {
                $list = Auth::User()->working_zone;
                $currentDistrict = WorkingZone::where('tier' , 2)->where('scope' , 'district')->where('id' , '=' , $list)->first();
                $cDistrict = $currentDistrict['name'];

                $view->with('cDistrict' , $cDistrict);
            }
        }
    }

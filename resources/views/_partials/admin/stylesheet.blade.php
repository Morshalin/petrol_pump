<!-- Global stylesheets -->
	
	<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/examples.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{asset('asset/global_assets/css/extras/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{asset('/css/parsley.css')}}">
	<!-- /global stylesheets -->
	<style>
	hr {
    margin-top: 4.25rem;
    margin-bottom: 1.25rem;
    border: 0;
    border-top:3px solid #44c7ee;
    border-radius: 4px;
}
	</style>
	@stack('admin.css')
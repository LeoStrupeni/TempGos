<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
    <div class="kt-header-mobile__logo">
        <a href="{{route('home.index')}}">        
			<img style="width: 3.5rem;" src="../img/logo.png">		           
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span style="background-color: #ffffff;"></span></button>              
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i style="color: #ffffff;" class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<style>
    

@media (max-width: 1024px){
.kt-header-mobile .kt-header-mobile__toolbar .kt-header-mobile__toggler span::before, .kt-header-mobile .kt-header-mobile__toolbar .kt-header-mobile__toggler span::after {
    background: #ffffff;
}
</style>
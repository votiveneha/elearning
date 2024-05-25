<style type="text/css">
	.footer-linb {
    border-top: 0px !important;
}
.footer-linb ul {
    list-style: none;
    display: flex;
    justify-content: center;
    margin-bottom: 0;
        padding-top: 10px;
        padding-bottom: 10px;
}
.footer-linb ul li a {
    color: #000;
    font-size: 15px;
    text-decoration: underline;
}
	.footer-linb ul li {
    margin-right: 34px;
}
.footer-linb {
    padding: 0;
    background: #f7f7f7;
    margin: 0;
    /* position: absolute; */
    width: 100%;
    z-index: 999;
    left: 0;
    right: 0;
    border-top: 1px solid #dcdcdc;
    bottom: 10px;
}
.contact_support {
    text-align: center;
}
.contact_support h4 {
    color: #2567d5;
    margin-bottom: 0px;
    font-size: 14px;
}
.contact_support p {
    color: #000000;
    padding-bottom: 0px;
    font-size: 14px;
    margin-bottom: 0px;
}

</style>

<div class="col-md-12 footer-linb mt-5">
	<ul> 
		<li><a href="{{ url('/about_us') }}"> About</a> </li>
		<li><a href="{{ url('/terms') }}"> Terms & Conditions</a> </li>
		<li><a href="{{ url('/privacy') }}">Privacy </a> </li>
        
	</ul>
    <div class="contact_support">
    	<h4>Contact Support</h4>
    	<p><a style="color:black" href="mailto:sales@mathifyhsc.com.au">sales@mathifyhsc.com.au</a></p>
    </div>		
</div>
<script src="https://mathifyhsc.com/dev/public/assets/js/demo.js"></script>
<script src="https://mathifyhsc.com/dev/public/assets/js/chartjs.min.js"></script>
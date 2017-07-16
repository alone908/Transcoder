<div id="loader"><img src="img/loading.gif" style="background-color:rgba(0,0,0,0)"></div>
<div id="ajax_err"><h1>Opps! </h1><h1>We're sorry, but something went wrong.</h1><br><br><br><a href="/Transcoder">Take me back to the homepage</a></div>

<style>

#loader{
  display: none;
  width: 100%;
  height: 100%;
  position: absolute;
  top:0px;
  left:0px;
  z-index: 5000;
  text-align: center;
  background: -webkit-radial-gradient(circle, rgba(255,255,255,0.6),rgba(100,100,100,0.6), rgba(0,0,0,1) ); /* For Safari 5.1 to 6.0 */
  background: -o-radial-gradient(circle, rgba(255,255,255,0.6),rgba(100,100,100,0.6), rgba(0,0,0,1) ); /* For Opera 11.6 to 12.0 */
  background: -moz-radial-gradient(circle, rgba(255,255,255,0.6),rgba(100,100,100,0.6), rgba(0,0,0,1) ); /* For Fx 3.6 to 15 */
  background: radial-gradient(circle, rgba(255,255,255,0.6),rgba(60,60,60,0.6), rgba(0,0,0,1) );
}

#loader::after{
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}

#loader > img {
  display: inline-block;
  vertical-align: middle;
}

#ajax_err {
  display: none;
  width: 100%;
  height: 100%;
  position: absolute;
  padding-top: 100px;
  top:0px;
  left:0px;
  z-index: 5000;
  text-align: center;
  color:white;
  background-color: rgba(0, 0, 0, 0.8);
}

#ajax_err h1 {
  font-size: 48px;
}

#ajax_err a {
  font-size: 20px;
}

#ajax_err a:hover {
  color: white;
}

</style>

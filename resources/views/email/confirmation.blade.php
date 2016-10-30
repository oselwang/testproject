<h2>
    <center>Welcome</center>
</h2>
<center><h3>{{$email}}</h3><br></center>
<center><h4>Thank you for signing up for Eatnshare</h4><br></center>
<center><h4>Please verify Your Email Address by clicking the link bellow.</h4><br></center>
<center>
    <button class="button" style="background:#6fd508;border-collapse:collapse;border-radius:35px;padding:20px 25px;"
            bgcolor="#00c9c9" style="">
        <a style="text-decoration:none;color:#fff;display:block;font-size:23px;font-style:italic"
           href='{{url("register/{$token}")}}'>Verify Your Email</a></button>
</center>


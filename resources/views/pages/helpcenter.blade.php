@include('templates.header')

<div>
    <h3 style="margin-top:100px; text-align:center; font-weight:bold;">How can we help you?</h3>
</div>
<form action="/search" method="get" style="text-align: center;">
    <input type="text" placeholder="Search help articles..." name="search" style="border:none; outline: none;border-radius: 50px 0px 0px 50px; width:500px; padding:10px; margin-right: -4px;"> <!-- Adjusted margin-right -->
    <button type="submit" style="border-radius: 0px 50px 50px 0px; background-color:#74CC4B; border:none; padding:10px;">
        <img src="/assets/images/plantifeedpics/search--icon.png" alt="img" style="width: 20px; height: 20px;">
    </button>
</form>


<div style="display: grid; grid-template-columns:251px 251px 251px 251px; justify-content:center; column-gap:40px; margin-top:80px;">

    <div style="display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/loginpass.png" alt="img" style="width: 50px; height: 50px;">
        <p style="font-weight: bold; margin-top:20px; font-size: 15px;">Login and Password</p>

        <p style="font-size: 14px;">Fix login issues and learn how to change and reset you password.</p>

    </div>


    <div style="display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/security.png" alt="img" style="width: 50px; height: 50px;">
        <p style="font-weight: bold; margin-top:20px; font-size: 15px;">Privacy and Security</p>

        <p style="font-size: 14px;">Control who can see what you share and add extra protection to your account.</p>

    </div>

    <div style="display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/post.png" alt="img" style="width: 50px; height: 50px;">
        <p style="font-weight: bold; margin-top:20px; font-size: 15px;">How to create a post</p>

        <p style="font-size: 14px;">Connect, share, and engage with co-farmers on the forum easily.</p>

    </div>


    <div style="display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/farmtable.png" alt="img" style="width: 50px; height: 50px;">
        <p style="font-weight: bold; margin-top:20px; font-size: 15px;">How to create a Farm Table</p>

        <p style="font-size: 14px; ">Discover how to create your own virtual farm and cultivate crops.</p>

    </div>




</div>


<div>
    <h3 style="font-weight: bold; text-align:center; margin-top:100px; margin-bottom:30px;"> Videos</h3>
</div>

<div style="display: grid; grid-template-columns:251px 251px 251px 251px; justify-content:center; column-gap:40px; margin-bottom:50px;">

    <div style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/plants.png" alt="img" style="width: 70px; height: 70px; margin-bottom:30px;">

        <p style="font-size: 15px; margin-bottom:50px;">How to create an account?</p>

    </div>


    <div style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/plants.png" alt="img" style="width: 70px; height: 70px; margin-bottom:30px;">

        <p style="font-size: 15px;">Step-by-step guide on how to use
            the virtual farm</p>

    </div>

    <div style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/plants.png" alt="img" style="width: 70px; height: 70px; margin-bottom:30px;">

        <p style="font-size: 15px;">Installation and setup on mobile devices.</p>

    </div>

    <div style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);display: flex; align-items:center; flex-direction:column; border-radius:25px; border:solid 1px; padding:20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
        <img src="/assets/images/plantifeedpics/plants.png" alt="img" style="width: 70px; height: 70px; margin-bottom:30px;">

        <p style="font-size: 15px;">How to create a farm table?</p>

    </div>

    @include('templates.footer')
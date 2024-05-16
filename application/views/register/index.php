<!-- BEGIN REGISTRATION FORM -->
<form class="register-form" action="login-create.php" method="post">
    <input type="hidden" name="formkey" id="formkey3" value="5f7d99d1d77285454d4e3fb788756f5a">
    <h3 class="form-title"><i class="fa fa-user"></i>&nbsp;Create Account</h3>
    <p class="hint"> Enter your personal details below: </p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">First Name</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" maxlength="30" /></div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Last Name</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" maxlength="30" /> </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" maxlength="100" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Choose Local Lane Office</label>
        <select name="localoffice" class="form-control">
            <option value="">Choose Local Lane Office</option>
            <option value="1">Ballston Spa, NY</option>
            <option value="2">Bath, NY</option>
            <option value="3">King Of Prussia, PA</option>
            <option value="4">Bedford, PA</option>
            <option value="5">Pulaski, PA</option>
            <option value="6">Bealeton, VA</option>
            <option value="7">Dublin, VA</option>
            <option value="8">Stateville, NC</option>
            <option value="9">Texas</option>
        </select>
    </div>
    <p class="hint"> Enter your account details below: </p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>
    <div class="form-group margin-top-20 margin-bottom-20">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="agree_eul" /> I agree to the
            <a href="#enduser" data-toggle="modal">End User License</a> 
            <span></span>                        
        </label>
        <div id="register_eul_error"> </div>
    </div>             
    <div class="form-group margin-top-20 margin-bottom-20">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="agree_tou" /> I agree to the <a href="#termsofuse" data-toggle="modal">Terms Of Use</a> 
            <span></span>                        
        </label>
        <div id="register_tou_error"> </div>
    </div>                
    <div class="form-actions">
        <button type="button" id="register-back-btn" class="btn red btn-outline">Back</button>
        <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right">Create</button>
        <span></span>
    </div>
</form>
<!-- END REGISTRATION FORM -->

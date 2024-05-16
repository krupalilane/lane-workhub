
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>StormStorage Online Configuration Tool | Lane Enterprises, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="StormStorage Online Configuration Tool &copy; Lane Enterprises, Inc." name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/login.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout3/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo-lane-header_75px.png" alt="" /></a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="login-proc.php" method="post">
                <input type="hidden" name="formkey" id="formkey1" value="5f7d99d1d77285454d4e3fb788756f5a">
                <h3 class="form-title"><i class="fa fa-lock"></i>&nbsp;Sign In</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter your email and password. </span>
                </div>
                          
             
               
                
             
              
             
              
                                                                                                                   
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red uppercase">Login</button>
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
                 <div class="create-account">
                    <p>
                        <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
                    </p>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="login-forgot.php" method="post">
                <input type="hidden" name="formkey" id="formkey2" value="5f7d99d1d77285454d4e3fb788756f5a">
                <h3 class="form-title"><i class="fa fa-unlock"></i>&nbsp;Reset Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn red">Back</button>
                    <button type="submit" class="btn btn-red uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
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
        </div>
        <div class="copyright"> 2024 &copy;  
            <a target="_blank" href="http://lane-enterprises.com">Lane Enterprises, Inc.</a>&nbsp;&middot;&nbsp;All Rights Reserved 
        </div>

        <div id="enduser" class="modal fade in" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">End-User License</h4>
                    </div>
                    <div class="modal-body">
                        <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>End-User License Agreement</h2>
                                    <p>This is a legal agreement between you and Lane Enterprises, Inc. (“Lane”) stating the terms that
                                    govern your use of the Storm Storage online configuration tool(the “Application”). This agreement,
                                    together with all updates, additional terms, software licenses, and all of Lane’s rules and policies,
                                    collectively constitute the “Agreement” between you and Lane. By installing the Application you are
                                    indicating that you agree to these terms. If you do not agree to these terms do not install or use the
                                    Application. You must accept and abide by these terms as presented to you. Changes, additions, or
                                    deletions are not acceptable, and Lane may refuse access to the Application for noncompliance with any
                                    part of the Agreement.</p><p>
                                    1. License. The Application is licensed, not sold, to you for use only under the terms of this Agreement.
                                    Lane, as the licensor, reserves all rights not expressly granted to you. This license granted to you for the
                                    Application by Lane is limited to a non-transferable license to use the Application on any internet enabled
                                    computer. This license does not allow you to use the Application on any device that you do not own or
                                    control, and you may not distribute or make the Application available over a network where it could be
                                    used by multiple devices at the same time. You may not rent, lease, lend, sell, redistribute or sublicense the
                                    Application. You may not copy (except as expressly permitted by this license and the Usage Rules),
                                    decompile, reverse engineer, disassemble, attempt to derive the source code of, modify, or create derivative
                                    works of the Application, any updates, or any part thereof (except as and only to the extent any foregoing
                                    restriction is prohibited by applicable law or to the extent as may be permitted by the licensing terms
                                    governing use of any open sourced components included with the Application). Any attempt to do so is a
                                    violation of the rights of Lane and its licensors. If you breach this restriction, you may be subject to
                                    prosecution and damages. The terms of the license will govern any upgrades provided by Lane that replace
                                    and/or supplement the original Application, unless such upgrade is accompanied by a separate license in
                                    which case the terms of that license will govern.</p><p>
                                    2. Consent to Use of Data. You agree that Lane may collect and use technical data and related
                                    information, including but not limited to technical information about your device, system and application
                                    software, and peripherals, that is gathered periodically to facilitate the provision of software updates,
                                    product support and other services to you (if any) related to the Application. You agree that Lane may
                                    collect data related to projects that are being designed with Lane software for the purpose of providing
                                    timely response and assistance. Lane may use this information, as long as it is in a form that does not
                                    personally identify you, to improve its products or to provide services or technologies to you.</p><p>
                                    3. Termination. The license is effective until terminated by you or Lane. Your rights under this license
                                    will terminate automatically without notice from the Lane if you fail to comply with any term(s) of this
                                    license. Upon termination of the license, you shall cease all use of the Application, and destroy all copies,
                                    full or partial, of the Application.</p><p>
                                    4. Services; Third Party Materials. The Application may enable access to Lane's and third party services
                                    and web sites (collectively and individually, "Services"). Use of the Services may require Internet access
                                    and that you accept additional terms of service. You understand that by using any of the Services, you may
                                    encounter content that may be deemed offensive, indecent, or objectionable, which content may or may not
                                    be identified as having explicit language, and that the results of any search or entering of a particular URL
                                    may automatically and unintentionally generate links or references to objectionable material. Nevertheless,
                                    you agree to use the Services at your sole risk and that Lane shall not have any liability to you for content
                                    that may be found to be offensive, indecent, or objectionable.</p><p>
                                    Certain Services may display, include or make available content, data, information, applications or
                                    materials from third parties (“Third Party Materials”) or provide links to certain third party web sites. By
                                    using the Services, you acknowledge and agree that Lane is not responsible for examining or evaluating the
                                    content, accuracy, completeness, timeliness, validity, copyright compliance, legality, decency, quality or
                                    any other aspect of such Third Party Materials or web sites. Lane does not warrant or endorse and does not
                                    assume and will not have any liability or responsibility to you or any other person for any Services, Third 
                                    Party Materials or web sites, or for any other materials, products, or services of third parties. Third Party
                                    Materials and links to other web sites are provided solely as a convenience to you.</p><p>
                                    You agree that any Services contain proprietary content, information and material that is protected by
                                    applicable intellectual property and other laws, including but not limited to copyright, and that you will not
                                    use such proprietary content, information or materials in any way whatsoever except for permitted use of
                                    the Services. No portion of the Services may be reproduced in any form or by any means. You agree not to
                                    modify, rent, lease, loan, sell, distribute, or create derivative works based on the Services, in any manner,
                                    and you shall not exploit the Services in any unauthorized way whatsoever, including but not limited to, by
                                    trespass or burdening network capacity. You further agree not to use the Services in any manner to harass,
                                    abuse, stalk, threaten, defame or otherwise infringe or violate the rights of any other party, and that the
                                    Lane is not in any way responsible for any such use by you, nor for any harassing, threatening, defamatory,
                                    offensive or illegal messages or transmissions that you may receive as a result of using any of the Services.
                                    Lane makes no representation that such Services and Materials are appropriate or available for use in any
                                    particular location. To the extent you choose to access such Services or Materials, you do so at your own
                                    initiative and are responsible for compliance with any applicable laws, including but not limited to
                                    applicable local laws. Lane, and its licensors, reserve the right to change, suspend, remove, or disable
                                    access to any Services at any time without notice. In no event will Lane be liable for the removal of or
                                    disabling of access to any such Services. Lane may also impose limits on the use of or access to certain
                                    Services, in any case and without notice or liability.</p><p>
                                    You understand that Lane may offer integration its own and/or with third party Services for your
                                    convenience. Further, you understand that Lane is not affiliated with or otherwise sponsored by these third
                                    party services. Lane shall not be responsible for the contents of, updates to, or privacy practices of these
                                    third parties, which may differ from those of Lane. The personal data you may choose to give to such third
                                    party Services are not covered by Lane's privacy policies. Some third party companies may choose to share
                                    their personal data with Lane, in which case such data sharing shall be governed by that third party's
                                    privacy policy. The personal data you may choose to give to Lane by means of registering the Application
                                    with Lane shall be governed by Lane's privacy policy which may be accessed on our website at
                                    ___________________.</p><p>
                                    5. No Support or Upgrade Obligation. Lane, its suppliers and distributors are not obligated to create or
                                    provide any support, corrections, updates, upgrades, bug fixes and/or enhancements of the Application.</p><p>
                                    6. No Warranty. YOU EXPRESSLY ACKNOWLEDGE AND AGREE THAT USE OF THE
                                    APPLICATION IS AT YOUR SOLE RISK AND THAT THE ENTIRE RISK AS TO SATISFACTORY
                                    QUALITY, PERFORMANCE, ACCURACY AND EFFORT IS WITH YOU. TO THE MAXIMUM
                                    EXTENT PERMITTED BY APPLICABLE LAW, THE APPLICATION AND ANY SERVICES
                                    PERFORMED OR PROVIDED BY THE APPLICATION ARE PROVIDED "AS IS" AND “AS
                                    AVAILABLE”, WITH ALL FAULTS AND WITHOUT WARRANTY OF ANY KIND, AND LANE
                                    HEREBY DISCLAIMS ALL WARRANTIES AND CONDITIONS WITH RESPECT TO THE
                                    APPLICATION AND ANY SERVICES, EITHER EXPRESS, IMPLIED OR STATUTORY,
                                    INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES AND/OR CONDITIONS OF
                                    MERCHANTABILITY, OF SATISFACTORY QUALITY, OF FITNESS FOR A PARTICULAR
                                    PURPOSE, OF ACCURACY, OF QUIET ENJOYMENT, AND NON-INFRINGEMENT OF THIRD
                                    PARTY RIGHTS. LANE DOES NOT WARRANT AGAINST INTERFERENCE WITH YOUR
                                    ENJOYMENT OF THE APPLICATION, THAT THE FUNCTIONS CONTAINED IN, OR SERVICES
                                    PERFORMED OR PROVIDED BY, THE APPLICATION WILL MEET YOUR REQUIREMENTS,
                                    THAT THE OPERATION OF THE APPLICATION OR SERVICES WILL BE UNINTERRUPTED OR
                                    ERROR-FREE, OR THAT DEFECTS IN THE APPLICATION OR SERVICES WILL BE CORRECTED.
                                    NO ORAL OR WRITTEN INFORMATION OR ADVICE GIVEN BY LANE OR ITS AUTHORIZED
                                    REPRESENTATIVES SHALL CREATE A WARRANTY. SHOULD THE APPLICATION OR
                                    SERVICES PROVE DEFECTIVE, YOU ASSUME THE ENTIRE COST OF ALL NECESSARY
                                    SERVICING, REPAIR OR CORRECTION. SOME JURISDICTIONS DO NOT ALLOW THE 
                                    EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS ON APPLICABLE STATUTORY
                                    RIGHTS OF A CONSUMER, SO THE ABOVE EXCLUSION AND LIMITATIONS MAY NOT APPLY
                                    TO YOU.</p><p>
                                    7. Limitation of Liability. TO THE EXTENT NOT PROHIBITED BY LAW, IN NO EVENT SHALL
                                    LANE BE LIABLE FOR PERSONAL INJURY, OR ANY INCIDENTAL, SPECIAL, INDIRECT OR
                                    CONSEQUENTIAL DAMAGES WHATSOEVER, INCLUDING, WITHOUT LIMITATION,
                                    DAMAGES FOR LOSS OF PROFITS, LOSS OF DATA, BUSINESS INTERRUPTION OR ANY
                                    OTHER COMMERCIAL DAMAGES OR LOSSES, ARISING OUT OF OR RELATED TO YOUR USE
                                    OR INABILITY TO USE THE APPLICATION, HOWEVER CAUSED, REGARDLESS OF THE
                                    THEORY OF LIABILITY (CONTRACT, TORT OR OTHERWISE) AND EVEN IF LANE HAS BEEN
                                    ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. SOME JURISDICTIONS DO NOT ALLOW
                                    THE LIMITATION OF LIABILITY FOR PERSONAL INJURY, OR OF INCIDENTAL OR
                                    CONSEQUENTIAL DAMAGES, SO THIS LIMITATION MAY NOT APPLY TO YOU. In no event
                                    shall Lane’s total liability to you for all damages (other than as may be required by applicable law in cases
                                    involving personal injury) exceed the amount of fifty dollars ($50.00). The foregoing limitations will apply
                                    even if the above stated remedy fails of its essential purpose.</p><p>
                                    8. Exportation. You may not use or otherwise export or re-export the Application except as authorized by
                                    United States law and the laws of the jurisdiction in which the Application was obtained. In particular, but
                                    without limitation, the Application may not be exported or re-exported (a) into any U.S. embargoed
                                    countries or (b) to anyone on the U.S. Treasury Department's list of Specially Designated Nationals or the
                                    U.S. Department of Commerce Denied Person’s List or Entity List. By using the Application, you
                                    represent and warrant that you are not located in any such country or on any such list. You also agree that
                                    you will not use these products for any purposes prohibited by United States law, including, without
                                    limitation, the development, design, manufacture or production of nuclear, missiles, or chemical or
                                    biological weapons.</p><p>
                                    9. U.S. Government Restricted Rights. The Application and related documentation are "Commercial
                                    Items", as that term is defined at 48 C.F.R. §2.101, consisting of "Commercial Computer Software" and
                                    "Commercial Computer Software Documentation", as such terms are used in 48 C.F.R. §12.212 or 48
                                    C.F.R. §227.7202, as applicable. Consistent with 48 C.F.R. §12.212 or 48 C.F.R. §227.7202-1 through
                                    227.7202-4, as applicable, the Commercial Computer Software and Commercial Computer Software
                                    Documentation are being licensed to U.S. Government end users (a) only as Commercial Items and (b)
                                    with only those rights as are granted to all other end users pursuant to the terms and conditions herein.
                                    Unpublished-rights are reserved under the copyright laws of the United States.</p><p>
                                    10. Applicable Law. The laws of the State of Pennsylvania, excluding its conflicts of law rules, govern
                                    this license and your use of the Application. Your use of the Application may also be subject to other local,
                                    state, national, or international laws. The sole and exclusive jurisdiction and venue for actions related to
                                    the subject matter hereof shall be the state and federal courts located in Dauphin County, Ohio, U.S.A.
                                    Both you and Lane consent to the jurisdiction of such courts and agree that process may be served in the
                                    manner provided herein for giving of notices or otherwise as allowed by Pennsylvania state or federal law.
                                    The parties agree that the UN Convention on Contracts for the International Sale of Goods (Vienna, 1980)
                                    shall not apply to this Agreement or to any dispute or transaction arising out of this Agreement.</p><p>
                                    11. Intellectual Property. You do not acquire under this Agreement any intellectual property or other
                                    proprietary rights, including without limitation, any patents, inventions, improvements, designs,
                                    trademarks, including any applications for same, copyright, rights in any confidential information or tradesecrets,
                                    in or relating in any way to the Application. Any grants not expressly granted herein are reserved.
                                    Except where otherwise specified, the contents of the Application are copyright (c) 2024 Lane Enterprises,
                                    Inc. All rights reserved. The contents of the Application are subject to protection under U.S. and foreign
                                    copyright laws. You are not permitted to use the copyrighted content outside of the normal functions of the
                                    Application without the prior written consent of Lane.
                                    “StormKeeper” and “Lane” are registered trademarks of Lane Enterprises, Inc. All other marks and names
                                    mentioned herein may be trademarks of their respective companies.</p><p>
                                    12. Third Party Beneficiary. You acknowledge and agree that KBMax, and KBMax’s subsidiaries, are
                                    third party beneficiaries of this agreement, and that, upon your acceptance of these terms and conditions,
                                    KBMax will have the right (and will be deemed to have accepted the right) to enforce this agreement
                                    against you as a third party beneficiary thereof.</p><p>
                                    13. Indemnification. You agree to indemnify, defend and hold Lane, its partners, licensors, affiliates,
                                    contractors, officers, directors, employees and agents harmless from all damages, losses and expenses
                                    arising directly or indirectly from (a) any negligent acts, omissions or willful misconduct by you, (b) your
                                    use of the Application, (c) any breach of this Agreement by you, and/or (d) your violation of any law or of
                                    any rights of any third party.</p><p>
                                    14. Equitable Remedies. You hereby agree that if the terms of this Agreement are not specifically
                                    enforced, Lane will be irreparably damaged, and therefore you agree that Lane shall be entitled, without
                                    bond, other security, proof of damages, to appropriate equitable remedies with respect any of this
                                    Agreement, in addition to any other available remedies.</p><p>
                                    15. Assignment. Lane may assign this Agreement without notice to you. You shall not assign this
                                    Agreement without the prior written consent of Lane (such consent may be withheld at Lane’s discretion).</p><p>
                                    16. Notices. If you have any questions or concerns about this Agreement, you may contact us at:</p><p>
                                    Lane Enterprises, Inc.<br>
                                    3905 Hartzdale Drive<br>
                                    Suite 514<br>
                                    Camp Hill, PA 17011<br>
                                    Email: storm-storage@lane-enterprises.com<br></p><p>
                                    17. Entire Agreement. Except as otherwise provided, herein, this Agreement constitutes the entire
                                    agreement between the parties respecting the Application and there are no provisions, representations or
                                    collateral agreements between the parties other than as set out in this Agreement. Lane reserves the right to
                                    make changes to this Agreement by providing you with reasonable notice of the change. If you continue to
                                    use the Application after notice of the change has been given, you shall be deemed to have accepted this
                                    change.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <!--<button type="button" class="btn red">Agree</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div id="termsofuse" class="modal fade in" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="termsofuse" aria-hidden="true"></button>
                        <h4 class="modal-title">Terms Of Use</h4>
                    </div>
                    <div class="modal-body">
                        <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Terms Of Use Agreement</h2>
                                    <p>Welcome to storm-storage.com (the "Site"). By using the Site, you are agreeing to comply with
                                    and be bound by the following terms of use. Please review the following terms carefully. If you
                                    do not agree to these terms, you should not use this site. The term "Lane Enterprises" or "us" or
                                    "we" or "our" refers to Lane Enterprises, Inc., the owner of the Site. The term "you" or "User"
                                    refers to the user or viewer of our Site.</p><p>
                                    1. Acceptance of Agreement.</p><p>
                                    You agree to the terms and conditions outlined in this Terms of Use Agreement ("Agreement")
                                    with respect to the Site. This Agreement is in addition to the terms of the End-User License
                                    Agreement you are required to accept if you use the Storm Storage Automated Design Tool
                                    constitutes the entire and only agreement between us and you with respect to the Site, and
                                    supersedes all prior or contemporaneous agreements, representations, warranties and
                                    understandings with respect to the Site and the subject matter of this Agreement.
                                    You understand and agree that you are entering into this Agreement electronically, which will
                                    have the same force and effect as an agreement in writing. You further agree that we may
                                    provide you with required notices and terms about the Site electronically, either by posting such
                                    notice on the Site or by other reasonable methods of notification. You may always review the
                                    most current version of this Agreement by clicking on the "Terms" or "Terms of Use" link on the
                                    home page of the Site.</p><p>
                                    2. Copyright.</p><p>
                                    In this Agreement, the content on the Site, including all information, data, logos, marks, designs,
                                    graphics, pictures, sound files, other files, and their selection and arrangement, is called
                                    "Content". All Content and all software available on the Site or used to create and operate the
                                    Site is the property of Lane Enterprises or its licensors, and is protected by domestic and
                                    international copyright laws, and all rights to the Site, such Content and such software are
                                    expressly reserved. All trademarks, registered trademarks, product names and company names
                                    or logos mentioned in the Site are the property of their respective owners. Reference to any
                                    products, services, processes or other information, by trade name, trademark, manufacturer,
                                    supplier or otherwise does not constitute or imply endorsement, sponsorship or recommendation
                                    thereof by Lane Enterprises.</p><p>
                                    3. Our Limited License of Content to You</p><p>
                                    Lane Enterprises grants you a limited, revocable, non-exclusive, non-sublicensable license to
                                    access the Site and to view, copy and print the portions of the Content available to you on the
                                    Site. Such license is subject to this Agreement, and specifically conditioned upon your
                                    compliance with this Agreement, including without limitation, the Restrictions and Prohibitions
                                    set forth in Section 4. Except as expressly permitted above, any use of any portion of the
                                    Content without the prior written permission of its owner is strictly prohibited and will terminate
                                    the license granted in this Section, this Agreement and your permission to use the Site. Any such
                                    unauthorized use may also violate applicable laws, including without limitation copyright and 
                                    trademark laws. Unless explicitly stated herein, nothing in this Agreement may be construed as
                                    conferring any license to intellectual property rights, whether by estoppel, implication or
                                    otherwise. The license in this Section is revocable by Lane Enterprises at any time.</p><p>
                                    4. Restrictions and Prohibitions on Use.</p><p>
                                    Your license for access and use of the Site and any information, materials or documents
                                    (collectively, the "Content and Materials") therein are subject to the following restrictions and
                                    prohibitions on use: You may not (a) copy, print (except for the express limited purpose
                                    permitted by Section 3 above), republish, display, distribute, transmit, sell, rent, lease, loan or
                                    otherwise make available in any form or by any means all or any portion of the Site or any
                                    Content and Materials retrieved therefrom; (b) use the Site or any materials obtained from the
                                    Site to develop, or as a component of, any information, storage and retrieval system, database,
                                    information base, or similar resource (in any media now existing or hereafter developed), that is
                                    offered for commercial distribution of any kind, including through sale, license, lease, rental,
                                    subscription, or any other commercial distribution mechanism; (c) create compilations or
                                    derivative works of any Content and Materials from the Site; (d) use any Content and Materials
                                    from the Site in any manner that may infringe any copyright, intellectual property right,
                                    proprietary right, or property right of us or any third parties; (e) remove, change or obscure any
                                    copyright notice or other proprietary notice or terms of use contained in the Site; (f) remove,
                                    decompile, disassemble or reverse engineer any Site software or use any network monitoring or
                                    discovery software to determine the Site architecture; (g) use any automatic or manual process to
                                    harvest information from the Site; (h) use the Site for the purpose of gathering information for or
                                    transmitting (1) unsolicited commercial email; (2) email that makes use of headers, invalid or
                                    nonexistent domain names, or other means of deceptive addressing; or (3) unsolicited telephone
                                    calls or facsimile transmissions; (i) use the Site in a manner that violates any state or federal law
                                    regulating email, facsimile transmissions or telephone solicitations; or (j) export or re-export the
                                    Site or any portion thereof, or any software available on or through the Site, in violation of the
                                    export control laws or regulations of the United States.</p><p>
                                    5. Linking to the Site.</p><p>
                                    You may provide links to the Site, provided (a) that you do not remove or obscure, by framing or
                                    otherwise, advertisements, the copyright notice, or other notices on the Site, (b) your site does
                                    not engage in illegal or pornographic activities, and (c) you discontinue providing links to the
                                    Site immediately upon request by us.</p><p>
                                    6. Advertisers.</p><p>
                                    The Site may contain advertising and sponsorships. Advertisers and sponsors are responsible for
                                    ensuring that material submitted for inclusion on the Site is accurate and complies with
                                    applicable laws. We are not responsible for the illegality or any error, inaccuracy or problem in
                                    the advertiser's or sponsor's materials.</p><p>
                                    7. Registration.</p><p>
                                    Certain sections of, or offerings from, the Site may require you to register. If registration is
                                    requested, you agree to provide us with accurate, complete registration information. You must 
                                    be at least 13 years old to use the Site. Your registration must be done using your real name and
                                    accurate information. Each registration is for your personal use only and not on behalf of any
                                    other person or entity. We do not permit any other person using the registered sections under
                                    your name. You are responsible for preventing such unauthorized use, and you agree to accept
                                    all risks of unauthorized access.</p><p>
                                    8. Errors, Corrections and Changes.</p><p>
                                    We do not represent or warrant that the Site will be error-free, free of viruses or other harmful
                                    components, or that defects will be corrected. We do not represent or warrant that the
                                    information available on or through the Site will be correct, accurate, timely or otherwise
                                    reliable. We may make changes to the features, functionality or content of the Site at any time.
                                    We reserve the right in our sole discretion to edit or delete any documents, information or other
                                    content appearing on the Site.</p><p>
                                    9. Third Party Content.</p><p>
                                    Third party content may appear on the Site or may be accessible via links from the Site. We are
                                    not responsible for and assume no liability for any mistakes, misstatements of law, defamation,
                                    omissions, falsehood, obscenity, pornography or profanity in the statements, opinions,
                                    representations or any other form of third party content on the Site. You understand that the
                                    information and opinions in the third party content represent solely the thoughts of the author
                                    and is neither endorsed by nor does it necessarily reflect our belief.</p><p>
                                    10. Unlawful Activity.</p><p>
                                    We reserve the right to investigate complaints or reported violations of this Agreement and to
                                    take any action we deem appropriate, including but not limited to reporting any suspected
                                    unlawful activity to law enforcement officials, regulators, or other third parties and disclosing
                                    any information necessary or appropriate to such persons or entities relating to your profile,
                                    email addresses, usage history, posted materials, IP addresses and traffic information.</p><p>
                                    11. Indemnification.</p><p>
                                    You agree to indemnify, defend and hold us and our partners, agents, officers, directors,
                                    employees, subcontractors, successors, assigns, third party suppliers of information and
                                    documents, attorneys, advertisers, product and service providers, and affiliates (collectively,
                                    "Affiliated Parties") harmless from any liability, loss, claim and expense, including reasonable
                                    attorney's fees, related to your violation of this Agreement or use of the Site.</p><p>
                                    12. Nontransferable.</p><p>
                                    Your right to use the Site is not transferable or assignable. Any password or right given to you to
                                    obtain information or documents is not transferable or assignable.</p><p>
                                    13. Disclaimer.</p><p>
                                    THE INFORMATION, CONTENT AND DOCUMENTS FROM OR THROUGH THE SITE 
                                    ARE PROVIDED "AS-IS," "AS AVAILABLE," WITH "ALL FAULTS", AND ALL
                                    WARRANTIES, EXPRESS OR IMPLIED, ARE DISCLAIMED (INCLUDING BUT NOT
                                    LIMITED TO THE DISCLAIMER OF ANY IMPLIED WARRANTIES OF
                                    MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE). THE
                                    INFORMATION AND SERVICES MAY CONTAIN BUGS, ERRORS, PROBLEMS OR
                                    OTHER LIMITATIONS. WE AND OUR AFFILIATED PARTIES HAVE NO LIABILITY
                                    WHATSOEVER FOR YOUR USE OF ANY INFORMATION OR SERVICE, EXCEPT AS
                                    PROVIDED IN SECTION 14(b). IN PARTICULAR, BUT NOT AS A LIMITATION
                                    THEREOF, WE AND OUR AFFILIATED PARTIES ARE NOT LIABLE FOR ANY
                                    INDIRECT, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES (INCLUDING
                                    DAMAGES FOR LOSS OF BUSINESS, LOSS OF PROFITS, LITIGATION, OR THE LIKE),
                                    WHETHER BASED ON BREACH OF CONTRACT, BREACH OF WARRANTY, TORT
                                    (INCLUDING NEGLIGENCE), PRODUCT LIABILITY OR OTHERWISE, EVEN IF
                                    ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE NEGATION AND
                                    LIMITATION OF DAMAGES SET FORTH ABOVE ARE FUNDAMENTAL ELEMENTS OF
                                    THE BASIS OF THE BARGAIN BETWEEN US AND YOU. THIS SITE AND THE
                                    PRODUCTS, SERVICES, DOCUMENTS AND INFORMATION PRESENTED WOULD
                                    NOT BE PROVIDED WITHOUT SUCH LIMITATIONS. NO ADVICE OR INFORMATION,
                                    WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM US THROUGH THE SITE
                                    OR OTHERWISE SHALL CREATE ANY WARRANTY, REPRESENTATION OR
                                    GUARANTEE NOT EXPRESSLY STATED IN THIS AGREEMENT.
                                    ALL RESPONSIBILITY OR LIABILITY FOR ANY DAMAGES CAUSED BY VIRUSES
                                    CONTAINED WITHIN THE ELECTRONIC FILE CONTAINING A FORM OR DOCUMENT
                                    IS DISCLAIMED.</p><p>
                                    14. Limitation of Liability</p><p>
                                    (a) We and any Affiliated Party shall not be liable for any loss, injury, claim, liability,
                                    or damage of any kind resulting in any way from (i) any errors in or omissions from the
                                    Site or any services or products obtainable therefrom, (ii) the unavailability or
                                    interruption of the Site or any features thereof, (iii) your use of the Site, or (iv) the
                                    content contained on the Site.</p><p>
                                    (b) THE AGGREGATE LIABILITY OF US AND THE AFFILIATED PARTIES IN
                                    CONNECTION WITH ANY CLAIM ARISING OUT OF OR RELATING TO THE
                                    SITE AND/OR THE PRODUCTS, INFORMATION, DOCUMENTS AND SERVICES
                                    PROVIDED HEREIN OR HEREBY SHALL NOT EXCEED $50 AND THAT
                                    AMOUNT SHALL BE IN LIEU OF ALL OTHER REMEDIES WHICH YOU MAY
                                    HAVE AGAINST US AND ANY AFFILIATED PARTY.</p><p>
                                    15. Use of Information.</p><p>
                                    We reserve the right, and you authorize us, to the use and assignment of all information
                                    regarding Site uses by you and all information provided by you in any manner consistent with
                                    our Privacy Policy. All remarks, suggestions, ideas, graphics, or other information
                                    communicated by you to us (collectively, a "Submission") will forever be our property. We will 
                                    not be required to treat any Submission as confidential, and will not be liable for any ideas
                                    (including without limitation, product, service or advertising ideas) and will not incur any
                                    liability as a result of any similarities that may appear in our future products, services or
                                    operations. Without limitation, we will have exclusive ownership of all present and future
                                    existing rights to the Submission of every kind and nature everywhere. We will be entitled to use
                                    the Submission for any commercial or other purpose whatsoever, without compensation to you
                                    or any other person sending the Submission. You acknowledge that you are responsible for
                                    whatever material you submit, and you, not us, have full responsibility for the message,
                                    including its legality, reliability, appropriateness, originality, and copyright.</p><p>
                                    16. Privacy Policy.</p><p>
                                    Our Privacy Policy, as it may change from time to time, is a part of this Agreement. You must
                                    review this Privacy Policy by clicking on this [link] or the link provided at the bottom of the
                                    home page of the Site.</p><p>
                                    17. Links to other Web Sites.</p><p>
                                    The Site may contain links to other Web sites. We are not responsible for the content, accuracy
                                    or opinions express in such Web sites, and such Web sites are not investigated, monitored or
                                    checked for accuracy or completeness by us. Inclusion of any linked Web site on our Site does
                                    not imply approval or endorsement of the linked Web site by us. If you decide to leave our Site
                                    and access these third-party sites, you do so at your own risk.</p><p>
                                    18. Legal Compliance.</p><p>
                                    You agree to comply with all applicable domestic and international laws, statutes, ordinances
                                    and regulations regarding your use of the Site and the Content and Materials provided therein.</p><p>
                                    19. Cancellation; Termination of Agreement</p><p>
                                    You and/or Lane Enterprises may terminate this Agreement and your use of the Site at any time.
                                    Specifically, we reserve the right to terminate your use of the Site without prior notice (a) if we
                                    believe in our discretion that you have violated or acted inconsistently with this Agreement or (b)
                                    if we determine in our sole discretion to terminate the Site's services to you or any other User.</p><p>
                                    20. Miscellaneous.</p><p>
                                    You and we are independent contracts, and nothing in this Agreement creates a partnership,
                                    employment relationship or agency. There are no third-party beneficiaries of this Agreement.
                                    You may not assign this Agreement, in whole or in part, to any third party without our prior,
                                    written consent, and any attempt by you to do so will be invalid.</p><p>
                                    This Agreement shall be treated as though it were executed and performed in Columbus, Ohio,
                                    and shall be governed by and construed in accordance with the laws of the State of Ohio (without
                                    regard to conflict of law principles). Any cause of action by you with respect to the Site (and/or
                                    any information, products or services related thereto) must be instituted within one (1) year after
                                    the cause of action arose or be forever waived and barred. All actions shall be subject to the 
                                    limitations set forth in Sections 13 and Section 14. The language in this Agreement shall be
                                    interpreted as to its fair meaning and not strictly for or against any party. This Agreement and all
                                    incorporated agreements and your information may be automatically assigned by us in our sole
                                    discretion to a third party in the event of an acquisition, sale or merger. Should any part of this
                                    Agreement be held invalid or unenforceable, that portion shall be construed consistent with
                                    applicable law and the remaining portions shall remain in full force and effect. To the extent that
                                    anything in or associated with the Site is in conflict or inconsistent with this Agreement, this
                                    Agreement shall take precedence. Our failure to enforce any provision of this Agreement shall
                                    not be deemed a waiver of such provision nor of the right to enforce such provision. Our rights
                                    under this Agreement shall survive any termination of this Agreement.</p><p>
                                    21. Questions and Comments.</p><p>
                                    If you have any questions regarding this Agreement or your use of the Site please contact us
                                    here:</p><p>
                                    Lane Enterprises, Inc.<br>
                                    3905 Hartzdale Drive<br>
                                    Suite 514<br>
                                    Camp Hill, PA 17011<br>
                                    Email: storm-storage@lane-enterprises.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <!--<button type="button" class="btn red">Agree</button>-->
                    </div>
                </div>
            </div>
        </div>
                          
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script type="text/javascript">
            jQuery.validator.addMethod("validate_email",function(value, element) {
                   if(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ))
                    {
                       return true;
                    }
                    else
                    {
                      return false;
                    }    
            },"Please enter a valid Email.");

            jQuery.validator.addMethod("pwcheck", function(value) {
                return /[A-Z]/.test(value) // has an uppercase letter
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
            },"Password must contain uppercase, lowercase and digits.");          
        </script>

        <script src="assets/pages/scripts/login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>
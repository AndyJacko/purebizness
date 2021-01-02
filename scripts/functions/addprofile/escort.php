<!-- Escort Profile -->
<br><br>
<div id="addwebsite" class="addwebsiteform">
  <form action="/scripts/functions/addprofile/savedetails.php" method="post" name="website">
    <label>Name<span class="small">Your full name</span></label>
    <input name="Name" type="text" id="Name" onKeyUp="checkchars('Name',80);" maxlength="80"><span id="NameChars" class="chars">Characters<br>Remaining: 80</span>
    <div class="clearfix"></div>
    <label>Password<span class="small">Choose a password</span></label>
    <input type="password" name="Password" id="Password" onKeyUp="checkchars('Password',20);" maxlength="20"><span id="PasswordChars" class="chars">Characters<br>Remaining: 20</span>
    <div class="clearfix"></div>
    <label>Website URL<span class="small">URL of your website</span></label>
    <input type="text" name="URL" id="URL">
    <div class="clearfix"></div>
    <label>Reciprocal URL<span class="small">Our URL on your website</span></label>
    <input type="text" name="Recip" id="Recip">
    <div class="clearfix"></div>
    <label>Email Address<span class="small">Your email address</span></label>
    <input type="email" name="Email" id="Email">
    <div class="clearfix"></div>
    <label>Phone Number<span class="small">Your phone number</span></label>
    <input type="text" name="Phone" id="Phone" onKeyUp="checkchars('Phone',20);" maxlength="20"><span id="PhoneChars" class="chars">Characters<br>Remaining: 20</span>
    <div class="clearfix"></div>
    <label>Age<span class="small">Your age range</span></label>
    <select name="Age" id="Age">
      <option value="1">18 - 20</option>
      <option value="2">21 - 30</option>
      <option value="3">31 - 40</option>
      <option value="4">41 - 50</option>
      <option value="5">Over 50</option>
    </select>
    <div class="clearfix"></div>
    <label>Gender<span class="small">Your gender</span></label>
    <select name="Gender" id="Gender">
      <option value="1">Male</option>
      <option value="2">Female</option>
      <option value="3">Pre-Op Transexual</option>
      <option value="4">Post-Op Transexual</option>
      <option value="5">Couple</option>
    </select>
    <div class="clearfix"></div>
    <label>Hair Colour<span class="small">Your hair colour</span></label>
    <select name="Hair" id="Hair">
      <option value="1">Blonde</option>
      <option value="2">Brown</option>
      <option value="3">Auburn</option>
      <option value="4">Black</option>
      <option value="5">Brunette</option>
      <option value="6">Red</option>
      <option value="7">Mixed</option>
      <option value="8">Gray</option>
      <option value="9">Bald</option>
    </select>
    <div class="clearfix"></div>
    <label>Eye Colour<span class="small">Your eye colour</span></label>
    <select name="Eye" id="Eye">
      <option value="1">Blue</option>
      <option value="2">Hazel</option>
      <option value="3">Brown</option>
      <option value="4">Green</option>
      <option value="5">Gray</option>
    </select>
    <div class="clearfix"></div>
    <label>Height<span class="small">Your height</span></label>
    <select name="Height" id="Height">
      <option value="1">Shorter Than 5 Foot</option>
      <option value="2">5 Foot</option>
      <option value="3">5 Foot 1 Inches</option>
      <option value="4">5 Foot 2 Inches</option>
      <option value="5">5 Foot 3 Inches</option>
      <option value="6">5 Foot 4 Inches</option>
      <option value="7">5 Foot 5 Inches</option>
      <option value="8">5 Foot 6 Inches</option>
      <option value="9">5 Foot 7 Inches</option>
      <option value="10">5 Foot 8 Inches</option>
      <option value="11">5 Foot 9 Inches</option>
      <option value="12">5 Foot 10 Inches</option>
      <option value="13">5 Foot 11 Inches</option>
      <option value="14">6 Foot</option>
      <option value="15">Taller Than 6 Foot</option>
    </select>
    <div class="clearfix"></div>
    <label>Prices<span class="small">Your charges per hour</span></label>
    <select name="Prices" id="Prices">
      <option value="1">Not Applicable</option>
      <option value="2">Not Given</option>
      <option value="3">Less Than &pound;50 per hour</option>
      <option value="4">&pound;60 per hour</option>
      <option value="5">&pound;70 per hour</option>
      <option value="6">&pound;80 per hour</option>
      <option value="7">&pound;90 per hour</option>
      <option value="8">&pound;100 per hour</option>
      <option value="9">&pound;100 - &pound;150 per hour</option>
      <option value="10">&pound;150 - &pound;200 per hour</option>
      <option value="11">&pound;200 - &pound;250 per hour</option>
      <option value="12">&pound;250 - &pound;300 per hour</option>
      <option value="13">More Than &pound;300 per hour</option>
    </select>
    <div class="clearfix"></div>
    <label>Call Type<span class="small">Where you work</span></label>
    <select name="Call" id="Call">
      <option value="1">Incall</option>
      <option value="2">Outcall</option>
      <option value="3">Incall & Outcall</option>
    </select>
    <div class="clearfix"></div>
    <label>Stats<span class="small">Your vital statistics</span></label>
    <input type="text" name="Stats" id="Stats" onKeyUp="checkchars('Stats',40);" maxlength="40"><span id="StatsChars" class="chars">Characters<br>Remaining: 40</span>
    <div class="clearfix"></div>
    <label>Country<span class="small">Your country of residence</span></label>
    <select name="Country" id="Country">
      <option value="Aaland Islands">Aaland Islands</option>
      <option value="Afghanistan">Afghanistan</option>
      <option value="Albania">Albania</option>
      <option value="Algeria">Algeria</option>
      <option value="American Samoa">American Samoa</option>
      <option value="Andorra">Andorra</option>
      <option value="Angola">Angola</option>
      <option value="Anguilla">Anguilla</option>
      <option value="Antigua And Barbuda">Antigua And Barbuda</option>
      <option value="Argentina">Argentina</option>
      <option value="Armenia">Armenia</option>
      <option value="Aruba">Aruba</option>
      <option value="Australia">Australia</option>
      <option value="Austria">Austria</option>
      <option value="Azerbaijan">Azerbaijan</option>
      <option value="Bahamas">Bahamas</option>
      <option value="Bahrain">Bahrain</option>
      <option value="Bangladesh">Bangladesh</option>
      <option value="Barbados">Barbados</option>
      <option value="Belarus">Belarus</option>
      <option value="Belgium">Belgium</option>
      <option value="Belize">Belize</option>
      <option value="Benin">Benin</option>
      <option value="Bermuda">Bermuda</option>
      <option value="Bhutan">Bhutan</option>
      <option value="Bolivia">Bolivia</option>
      <option value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
      <option value="Botswana">Botswana</option>
      <option value="Brazil">Brazil</option>
      <option value="Bulgaria">Bulgaria</option>
      <option value="Burkina Faso">Burkina Faso</option>
      <option value="Burundi">Burundi</option>
      <option value="Cambodia">Cambodia</option>
      <option value="Cameroon">Cameroon</option>
      <option value="Canada">Canada</option>
      <option value="Cape Verde">Cape Verde</option>
      <option value="Cayman Islands">Cayman Islands</option>
      <option value="Chad">Chad</option>
      <option value="Chile">Chile</option>
      <option value="China">China</option>
      <option value="Christmas Island">Christmas Island</option>
      <option value="Colombia">Colombia</option>
      <option value="Congo">Congo</option>
      <option value="Cook Islands">Cook Islands</option>
      <option value="Costa Rica">Costa Rica</option>
      <option value="Croatia">Croatia</option>
      <option value="Cuba">Cuba</option>
      <option value="Cyprus">Cyprus</option>
      <option value="Czech Republic">Czech Republic</option>
      <option value="Denmark">Denmark</option>
      <option value="Djibouti">Djibouti</option>
      <option value="Dominican Republic">Dominican Republic</option>
      <option value="East Timor">East Timor</option>
      <option value="Egypt">Egypt</option>
      <option value="El Salvador">El Salvador</option>
      <option value="England">England</option>
      <option value="Equador">Ecuador</option>
      <option value="Estonia">Estonia</option>
      <option value="Ethiopia">Ethiopia</option>
      <option value="Falklands Islands">Falklands Islands</option>
      <option value="Fiji">Fiji</option>
      <option value="Finland">Finland</option>
      <option value="France">France</option>
      <option value="Gabon">Gabon</option>
      <option value="Gambia">Gambia</option>
      <option value="Georgia">Georgia</option>
      <option value="Germany">Germany</option>
      <option value="Ghana">Ghana</option>
      <option value="Gibraltar">Gibraltar</option>
      <option value="Greece">Greece</option>
      <option value="Greenland">Greenland</option>
      <option value="Guam">Guam</option>
      <option value="Guatemala">Guatemala</option>
      <option value="Guernsey">Guernsey</option>
      <option value="Guinea">Guinea</option>
      <option value="Guyana">Guyana</option>
      <option value="Haiti">Haiti</option>
      <option value="Honduras">Honduras</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Hungary">Hungary</option>
      <option value="Iceland">Iceland</option>
      <option value="India">India</option>
      <option value="Indonesia">Indonesia</option>
      <option value="Iran">Iran</option>
      <option value="Iraq">Iraq</option>
      <option value="Ireland">Ireland</option>
      <option value="Isle Of Man">Isle Of Man</option>
      <option value="Israel">Israel</option>
      <option value="Italy">Italy</option>
      <option value="Jamaica">Jamaica</option>
      <option value="Japan">Japan</option>
      <option value="Jersey">Jersey</option>
      <option value="Jordan">Jordan</option>
      <option value="Kazakhstan">Kazakhstan</option>
      <option value="Kenya">Kenya</option>
      <option value="Kuwait">Kuwait</option>
      <option value="Latvia">Latvia</option>
      <option value="Lebanon">Lebanon</option>
      <option value="Liberia">Liberia</option>
      <option value="Liechtenstein">Liechtenstein</option>
      <option value="Lithuania">Lithuania</option>
      <option value="Luxembourg">Luxembourg</option>
      <option value="Madagascar">Madagascar</option>
      <option value="Malawi">Malawi</option>
      <option value="Malaysia">Malaysia</option>
      <option value="Maldives">Maldives</option>
      <option value="Mali">Mali</option>
      <option value="Malta">Malta</option>
      <option value="Mauritius">Mauritius</option>
      <option value="Mexico">Mexico</option>
      <option value="Monaco">Monaco</option>
      <option value="Mongolia">Mongolia</option>
      <option value="Morocco">Morocco</option>
      <option value="Mozambique">Mozambique</option>
      <option value="Nambia">Namibia</option>
      <option value="Netherlands">Netherlands</option>
      <option value="New Caledonia">New Caledonia</option>
      <option value="New Zealand">New Zealand</option>
      <option value="Nigeria">Nigeria</option>
      <option value="North Korea">North Korea</option>
      <option value="Norway">Norway</option>
      <option value="Oman">Oman</option>
      <option value="Pakistan">Pakistan</option>
      <option value="Panama">Panama</option>
      <option value="Papua New Guinea">Papua New Guinea</option>
      <option value="Paraguay">Paraguay</option>
      <option value="Peru">Peru</option>
      <option value="Phillipines">Philippines</option>
      <option value="Poland">Poland</option>
      <option value="Portugal">Portugal</option>
      <option value="Puerto Rico">Puerto Rico</option>
      <option value="Romania">Romania</option>
      <option value="Rwanda">Rwanda</option>
      <option value="Samoa">Samoa</option>
      <option value="San Marino">San Marino</option>
      <option value="Saudi Arabia">Saudi Arabia</option>
      <option value="Scotland">Scotland</option>
      <option value="Senegal">Senegal</option>
      <option value="Seychelles">Seychelles</option>
      <option value="Sierra Leone">Sierra Leone</option>
      <option value="Singapore">Singapore</option>
      <option value="Slovakia">Slovakia</option>
      <option value="Slovenia">Slovenia</option>
      <option value="Somalia">Somalia</option>
      <option value="South Africa">South Africa</option>
      <option value="South Korea">South Korea</option>
      <option value="Spain">Spain</option>
      <option value="Sri Lanka">Sri Lanka</option>
      <option value="St Kitts And Nevis">St Kitts And Nevis</option>
      <option value="St Lucia">St Lucia</option>
      <option value="St Pierre And Miquelon">St Pierre And Miquelon</option>
      <option value="St Vincent And Grenadines">St Vincent And Grenadines</option>
      <option value="Sudan">Sudan</option>
      <option value="Sweden">Sweden</option>
      <option value="Switzerland">Switzerland</option>
      <option value="Taiwan">Taiwan</option>
      <option value="Thailand">Thailand</option>
      <option value="Trinidad And Tobago">Trinidad And Tobago</option>
      <option value="Tunisia">Tunisia</option>
      <option value="Turkey">Turkey</option>
      <option value="UAE">United Arab Emirates</option>
      <option value="Uganda">Uganda</option>
      <option value="Ukraine">Ukraine</option>
      <option value="United Kingdom" selected="selected">United Kingdom</option>
      <option value="USA">USA</option>
      <option value="Wales">Wales</option>
      <option value="Yugoslavia">Yugoslavia</option>
    </select>
    <div class="clearfix"></div>
    <label>Area (Country)<span class="small">Area you work in</span></label>
    <input type="text" name="Area" id="Area" onKeyUp="checkchars('Area',20);" maxlength="20"><span id="AreaChars" class="chars">Characters<br>Remaining: 20</span>
    <div class="clearfix"></div>
    <label>Keywords<span class="small">Upto 10, seperate by comma</span></label>
    <input type="text" name="Keywords" id="Keywords" onKeyUp="checkchars('Keywords',250);" maxlength="250"><span id="KeywordsChars" class="chars">Characters<br>Remaining: 250</span>
    <div class="clearfix"></div>
    <label>Description<span class="small">Description of yourself</span></label>
    <textarea name="Description" rows="8" id="Description" onKeyUp="checkchars('Description',1000);" maxlength="1000"></textarea><span id="DescriptionChars" class="chars">Characters<br>Remaining: 1000</span>
    <div class="clearfix"></div>
    <input name="listtype" type="hidden" value="4">
    <input name="subid" type="hidden" value="<?php echo $_GET["sub"]; ?>">
    <button type="submit" onClick="return valaddescortform();">ADD PROFILE</button>
  </form>
</div>
<br><br>

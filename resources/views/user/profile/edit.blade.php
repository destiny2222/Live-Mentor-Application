@extends('layouts.master')
@section('content')
    
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Profile</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->



<form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Password</div>
                </div>
                <div class="card-body">
                    
                    <div class="text-center chat-image mb-5">
                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                            <a class="javascript:void(0)" href="{{ route('dashboard') }}">
                                <img id="profileImage" alt="avatar" src="{{ asset('profile/'.$profile->image)  }}" class="brround">
                            </a>
                            
                        </div>
                        
                        <div class="mb-3 mb-3">
                            <label for="file" class="btn btn-info btn-sm">Change profile image</label>
                            <input type="file" id="file" name="image" accept="image/*" hidden class="form-control">
                        </div>
                        <div class="main-chat-msg-name">
                            <a href="javascript:void(0)">
                                <h5 class="mb-1 text-dark fw-semibold">{{ $profile->name }}</h5>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group no-margin">
                        <li class="list-group-item d-flex ps-3">
                            <div class="social social-profile-buttons me-2">
                                <a class="social-icon text-primary" href="javascript:void(0)"><i class="fe fe-mail"></i></a>
                            </div>
                            <a href="javascript:void(0)" class="my-auto">{{ $profile->email }}</a>
                        </li>
                        <li class="list-group-item d-flex ps-3">
                            <div class="social social-profile-buttons me-2">
                                <a class="social-icon text-primary" href="javascript:void(0)"><i class="fe fe-phone"></i></a>
                            </div>
                            <a href="javascript:void(0)" class="my-auto">{{ $profile->phone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputname">Full Name</label>
                                    <input type="text" class="form-control" id="exampleInputname" name="name" value="{{ $profile->name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputname1">Email Address</label>
                                    <input type="email" class="form-control" id="exampleInputname1" name="email" value="{{ $profile->email ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="{{ $profile->phone ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control select2 form-select">
                                <option>Select</option>
                                <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $profile->gender == 'female' ? 'selected' : ''}}>Female</option>
                                <option value="other" {{ $profile->gender == 'other' ? 'selected' : ''}}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <select id="country" name="country" class="form-control select2 form-select">
                                <option value="Afghanistan" {{ $profile->country == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                <option value="Åland Islands" {{ $profile->country == 'Åland Islands' ? 'selected' : '' }}>Åland Islands</option>
                                <option value="Albania" {{ $profile->country == 'Albania' ? 'selected' : '' }}>Albania</option>
                                <option value="Algeria" {{ $profile->country == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                <option value="American Samoa" {{ $profile->country == 'American Samoa' ? 'selected' : '' }}>American Samoa</option>
                                <option value="Andorra" {{ $profile->country == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                <option value="Angola" {{ $profile->country == 'Angola' ? 'selected' : '' }}>Angola</option>
                                <option value="Anguilla" {{ $profile->country == 'Anguilla' ? 'selected' : '' }}>Anguilla</option>
                                <option value="Antarctica" {{ $profile->country == 'Antarctica' ? 'selected' : '' }}>Antarctica</option>
                                <option value="Antigua and Barbuda" {{ $profile->country == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                <option value="Argentina" {{ $profile->country == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                <option value="Armenia" {{ $profile->country == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                <option value="Aruba" {{ $profile->country == 'Aruba' ? 'selected' : '' }}>Aruba</option>
                                <option value="Australia" {{ $profile->country == 'Australia' ? 'selected' : '' }}>Australia</option>
                                <option value="Austria" {{ $profile->country == 'Austria' ? 'selected' : '' }}>Austria</option>
                                <option value="Azerbaijan" {{ $profile->country == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                <option value="Bahamas" {{ $profile->country == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                <option value="Bahrain" {{ $profile->country == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                <option value="Bangladesh" {{ $profile->country == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                <option value="Barbados" {{ $profile->country == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                <option value="Belarus" {{ $profile->country == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                <option value="Belgium" {{ $profile->country == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                <option value="Belize" {{ $profile->country == 'Belize' ? 'selected' : '' }}>Belize</option>
                                <option value="Benin" {{ $profile->country == 'Benin' ? 'selected' : '' }}>Benin</option>
                                <option value="Bermuda" {{ $profile->country == 'Bermuda' ? 'selected' : '' }}>Bermuda</option>
                                <option value="Bhutan" {{ $profile->country == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                <option value="Bolivia" {{ $profile->country == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                <option value="Bosnia and Herzegovina" {{ $profile->country == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                <option value="Botswana" {{ $profile->country == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                <option value="Bouvet Island" {{ $profile->country == 'Bouvet Island' ? 'selected' : '' }}>Bouvet Island</option>
                                <option value="Brazil" {{ $profile->country == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                <option value="British Indian Ocean Territory" {{ $profile->country == 'British Indian Ocean Territory' ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam" {{ $profile->country == 'Brunei Darussalam' ? 'selected' : '' }}>Brunei Darussalam</option>
                                <option value="Bulgaria" {{ $profile->country == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                <option value="Burkina Faso" {{ $profile->country == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                <option value="Burundi" {{ $profile->country == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                <option value="Cambodia" {{ $profile->country == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                <option value="Cameroon" {{ $profile->country == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                <option value="Canada" {{ $profile->country == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Cape Verde" {{ $profile->country == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                                <option value="Cayman Islands" {{ $profile->country == 'Cayman Islands' ? 'selected' : '' }}>Cayman Islands</option>
                                <option value="Central African Republic" {{ $profile->country == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                <option value="Chad" {{ $profile->country == 'Chad' ? 'selected' : '' }}>Chad</option>
                                <option value="Chile" {{ $profile->country == 'Chile' ? 'selected' : '' }}>Chile</option>
                                <option value="China" {{ $profile->country == 'China' ? 'selected' : '' }}>China</option>
                                <option value="Christmas Island" {{ $profile->country == 'Christmas Island' ? 'selected' : '' }}>Christmas Island</option>
                                <option value="Cocos (Keeling) Islands" {{ $profile->country == 'Cocos (Keeling) Islands' ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                <option value="Colombia" {{ $profile->country == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                <option value="Comoros" {{ $profile->country == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                <option value="Congo" {{ $profile->country == 'Congo' ? 'selected' : '' }}>Congo</option>
                                <option value="Congo, The Democratic Republic of The" {{ $profile->country == 'Congo, The Democratic Republic of The' ? 'selected' : '' }}>Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands" {{ $profile->country == 'Cook Islands' ? 'selected' : '' }}>Cook Islands</option>
                                <option value="Costa Rica" {{ $profile->country == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                <option value="Cote D'ivoire" {{ $profile->country == 'Cote D\'ivoire' ? 'selected' : '' }}>Cote D'ivoire</option>
                                <option value="Croatia" {{ $profile->country == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                <option value="Cuba" {{ $profile->country == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                <option value="Cyprus" {{ $profile->country == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                <option value="Czech Republic" {{ $profile->country == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                <option value="Denmark" {{ $profile->country == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                <option value="Djibouti" {{ $profile->country == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                <option value="Dominica" {{ $profile->country == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                <option value="Dominican Republic" {{ $profile->country == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                <option value="Ecuador" {{ $profile->country == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                <option value="Egypt" {{ $profile->country == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                <option value="El Salvador" {{ $profile->country == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                <option value="Equatorial Guinea" {{ $profile->country == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                                <option value="Eritrea" {{ $profile->country == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                <option value="Estonia" {{ $profile->country == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                <option value="Ethiopia" {{ $profile->country == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)" {{ $profile->country == 'Falkland Islands (Malvinas)' ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands" {{ $profile->country == 'Faroe Islands' ? 'selected' : '' }}>Faroe Islands</option>
                                <option value="Fiji" {{ $profile->country == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                <option value="Finland" {{ $profile->country == 'Finland' ? 'selected' : '' }}>Finland</option>
                                <option value="France" {{ $profile->country == 'France' ? 'selected' : '' }}>France</option>
                                <option value="French Guiana" {{ $profile->country == 'French Guiana' ? 'selected' : '' }}>French Guiana</option>
                                <option value="French Polynesia" {{ $profile->country == 'French Polynesia' ? 'selected' : '' }}>French Polynesia</option>
                                <option value="French Southern Territories" {{ $profile->country == 'French Southern Territories' ? 'selected' : '' }}>French Southern Territories</option>
                                <option value="Gabon" {{ $profile->country == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                <option value="Gambia" {{ $profile->country == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                                <option value="Georgia" {{ $profile->country == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                <option value="Germany" {{ $profile->country == 'Germany' ? 'selected' : '' }}>Germany</option>
                                <option value="Ghana" {{ $profile->country == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                <option value="Gibraltar" {{ $profile->country == 'Gibraltar' ? 'selected' : '' }}>Gibraltar</option>
                                <option value="Greece" {{ $profile->country == 'Greece' ? 'selected' : '' }}>Greece</option>
                                <option value="Greenland" {{ $profile->country == 'Greenland' ? 'selected' : '' }}>Greenland</option>
                                <option value="Grenada" {{ $profile->country == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                                <option value="Guadeloupe" {{ $profile->country == 'Guadeloupe' ? 'selected' : '' }}>Guadeloupe</option>
                                <option value="Guam" {{ $profile->country == 'Guam' ? 'selected' : '' }}>Guam</option>
                                <option value="Guatemala" {{ $profile->country == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                <option value="Guernsey" {{ $profile->country == 'Guernsey' ? 'selected' : '' }}>Guernsey</option>
                                <option value="Guinea" {{ $profile->country == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                                <option value="Guinea-bissau" {{ $profile->country == 'Guinea-bissau' ? 'selected' : '' }}>Guinea-bissau</option>
                                <option value="Guyana" {{ $profile->country == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                <option value="Haiti" {{ $profile->country == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                <option value="Heard Island and Mcdonald Islands" {{ $profile->country == 'Heard Island and Mcdonald Islands' ? 'selected' : '' }}>Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)" {{ $profile->country == 'Holy See (Vatican City State)' ? 'selected' : '' }}>Holy See (Vatican City State)</option>
                                <option value="Honduras" {{ $profile->country == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                <option value="Hong Kong" {{ $profile->country == 'Hong Kong' ? 'selected' : '' }}>Hong Kong</option>
                                <option value="Hungary" {{ $profile->country == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                <option value="Iceland" {{ $profile->country == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                <option value="India" {{ $profile->country == 'India' ? 'selected' : '' }}>India</option>
                                <option value="Indonesia" {{ $profile->country == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Iran, Islamic Republic of" {{ $profile->country == 'Iran, Islamic Republic of' ? 'selected' : '' }}>Iran, Islamic Republic of</option>
                                <option value="Iraq" {{ $profile->country == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                <option value="Ireland" {{ $profile->country == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                <option value="Isle of Man" {{ $profile->country == 'Isle of Man' ? 'selected' : '' }}>Isle of Man</option>
                                <option value="Israel" {{ $profile->country == 'Israel' ? 'selected' : '' }}>Israel</option>
                                <option value="Italy" {{ $profile->country == 'Italy' ? 'selected' : '' }}>Italy</option>
                                <option value="Jamaica" {{ $profile->country == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                <option value="Japan" {{ $profile->country == 'Japan' ? 'selected' : '' }}>Japan</option>
                                <option value="Jersey" {{ $profile->country == 'Jersey' ? 'selected' : '' }}>Jersey</option>
                                <option value="Jordan" {{ $profile->country == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                <option value="Kazakhstan" {{ $profile->country == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                <option value="Kenya" {{ $profile->country == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                <option value="Kiribati" {{ $profile->country == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                <option value="Korea, Democratic People's Republic of" {{ $profile->country == 'Korea, Democratic People\'s Republic of' ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of" {{ $profile->country == 'Korea, Republic of' ? 'selected' : '' }}>Korea, Republic of</option>
                                <option value="Kuwait" {{ $profile->country == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                <option value="Kyrgyzstan" {{ $profile->country == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic" {{ $profile->country == 'Lao People\'s Democratic Republic' ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                                <option value="Latvia" {{ $profile->country == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                <option value="Lebanon" {{ $profile->country == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                <option value="Lesotho" {{ $profile->country == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                <option value="Liberia" {{ $profile->country == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                <option value="Libyan Arab Jamahiriya" {{ $profile->country == 'Libyan Arab Jamahiriya' ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein" {{ $profile->country == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                <option value="Lithuania" {{ $profile->country == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                <option value="Luxembourg" {{ $profile->country == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                <option value="Macao" {{ $profile->country == 'Macao' ? 'selected' : '' }}>Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of" {{ $profile->country == 'Macedonia, The Former Yugoslav Republic of' ? 'selected' : '' }}>Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar" {{ $profile->country == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                <option value="Malawi" {{ $profile->country == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                <option value="Malaysia" {{ $profile->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="Maldives" {{ $profile->country == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                <option value="Mali" {{ $profile->country == 'Mali' ? 'selected' : '' }}>Mali</option>
                                <option value="Malta" {{ $profile->country == 'Malta' ? 'selected' : '' }}>Malta</option>
                                <option value="Marshall Islands" {{ $profile->country == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                                <option value="Martinique" {{ $profile->country == 'Martinique' ? 'selected' : '' }}>Martinique</option>
                                <option value="Mauritania" {{ $profile->country == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                <option value="Mauritius" {{ $profile->country == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                <option value="Mayotte" {{ $profile->country == 'Mayotte' ? 'selected' : '' }}>Mayotte</option>
                                <option value="Mexico" {{ $profile->country == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                <option value="Micronesia, Federated States of" {{ $profile->country == 'Micronesia, Federated States of' ? 'selected' : '' }}>Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of" {{ $profile->country == 'Moldova, Republic of' ? 'selected' : '' }}>Moldova, Republic of</option>
                                <option value="Monaco" {{ $profile->country == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                <option value="Mongolia" {{ $profile->country == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                <option value="Montserrat" {{ $profile->country == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                <option value="Morocco" {{ $profile->country == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                <option value="Mozambique" {{ $profile->country == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                <option value="Myanmar" {{ $profile->country == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                <option value="Namibia" {{ $profile->country == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                <option value="Nauru" {{ $profile->country == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                <option value="Nepal" {{ $profile->country == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                <option value="Netherlands" {{ $profile->country == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                <option value="Netherlands Antilles" {{ $profile->country == 'Netherlands Antilles' ? 'selected' : '' }}>Netherlands Antilles</option>
                                <option value="New Caledonia" {{ $profile->country == 'New Caledonia' ? 'selected' : '' }}>New Caledonia</option>
                                <option value="New Zealand" {{ $profile->country == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                <option value="Nicaragua" {{ $profile->country == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                <option value="Niger" {{ $profile->country == 'Niger' ? 'selected' : '' }}>Niger</option>
                                <option value="Nigeria" {{ $profile->country == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                <option value="Niue" {{ $profile->country == 'Niue' ? 'selected' : '' }}>Niue</option>
                                <option value="Norfolk Island" {{ $profile->country == 'Norfolk Island' ? 'selected' : '' }}>Norfolk Island</option>
                                <option value="Northern Mariana Islands" {{ $profile->country == 'Northern Mariana Islands' ? 'selected' : '' }}>Northern Mariana Islands</option>
                                <option value="Norway" {{ $profile->country == 'Norway' ? 'selected' : '' }}>Norway</option>
                                <option value="Oman" {{ $profile->country == 'Oman' ? 'selected' : '' }}>Oman</option>
                                <option value="Pakistan" {{ $profile->country == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                <option value="Palau" {{ $profile->country == 'Palau' ? 'selected' : '' }}>Palau</option>
                                <option value="Palestinian Territory, Occupied" {{ $profile->country == 'Palestinian Territory, Occupied' ? 'selected' : '' }}>Palestinian Territory, Occupied</option>
                                <option value="Panama" {{ $profile->country == 'Panama' ? 'selected' : '' }}>Panama</option>
                                <option value="Papua New Guinea" {{ $profile->country == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                                <option value="Paraguay" {{ $profile->country == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                <option value="Peru" {{ $profile->country == 'Peru' ? 'selected' : '' }}>Peru</option>
                                <option value="Philippines" {{ $profile->country == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                <option value="Pitcairn" {{ $profile->country == 'Pitcairn' ? 'selected' : '' }}>Pitcairn</option>
                                <option value="Poland" {{ $profile->country == 'Poland' ? 'selected' : '' }}>Poland</option>
                                <option value="Portugal" {{ $profile->country == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                <option value="Puerto Rico" {{ $profile->country == 'Puerto Rico' ? 'selected' : '' }}>Puerto Rico</option>
                                <option value="Qatar" {{ $profile->country == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                <option value="Reunion" {{ $profile->country == 'Reunion' ? 'selected' : '' }}>Reunion</option>
                                <option value="Romania" {{ $profile->country == 'Romania' ? 'selected' : '' }}>Romania</option>
                                <option value="Russian Federation" {{ $profile->country == 'Russian Federation' ? 'selected' : '' }}>Russian Federation</option>
                                <option value="Rwanda" {{ $profile->country == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                <option value="Saint Helena" {{ $profile->country == 'Saint Helena' ? 'selected' : '' }}>Saint Helena</option>
                                <option value="Saint Kitts and Nevis" {{ $profile->country == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                <option value="Saint Lucia" {{ $profile->country == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon" {{ $profile->country == 'Saint Pierre and Miquelon' ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines" {{ $profile->country == 'Saint Vincent and The Grenadines' ? 'selected' : '' }}>Saint Vincent and The Grenadines</option>
                                <option value="Samoa" {{ $profile->country == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                <option value="San Marino" {{ $profile->country == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                <option value="Sao Tome and Principe" {{ $profile->country == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                <option value="Saudi Arabia" {{ $profile->country == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                <option value="Senegal" {{ $profile->country == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                <option value="Serbia" {{ $profile->country == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                <option value="Seychelles" {{ $profile->country == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                <option value="Sierra Leone" {{ $profile->country == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                <option value="Singapore" {{ $profile->country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                <option value="Slovakia" {{ $profile->country == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                <option value="Slovenia" {{ $profile->country == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                <option value="Solomon Islands" {{ $profile->country == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                                <option value="Somalia" {{ $profile->country == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                <option value="South Africa" {{ $profile->country == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands" {{ $profile->country == 'South Georgia and The South Sandwich Islands' ? 'selected' : '' }}>South Georgia and The South Sandwich Islands</option>
                                <option value="Spain" {{ $profile->country == 'Spain' ? 'selected' : '' }}>Spain</option>
                                <option value="Sri Lanka" {{ $profile->country == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                <option value="Sudan" {{ $profile->country == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                <option value="Suriname" {{ $profile->country == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                                <option value="Svalbard and Jan Mayen" {{ $profile->country == 'Svalbard and Jan Mayen' ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                <option value="Swaziland" {{ $profile->country == 'Swaziland' ? 'selected' : '' }}>Swaziland</option>
                                <option value="Sweden" {{ $profile->country == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                <option value="Switzerland" {{ $profile->country == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                <option value="Syrian Arab Republic" {{ $profile->country == 'Syrian Arab Republic' ? 'selected' : '' }}>Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China" {{ $profile->country == 'Taiwan, Province of China' ? 'selected' : '' }}>Taiwan, Province of China</option>
                                <option value="Tajikistan" {{ $profile->country == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                <option value="Tanzania, United Republic of" {{ $profile->country == 'Tanzania, United Republic of' ? 'selected' : '' }}>Tanzania, United Republic of</option>
                                <option value="Thailand" {{ $profile->country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                <option value="Timor-leste" {{ $profile->country == 'Timor-leste' ? 'selected' : '' }}>Timor-leste</option>
                                <option value="Togo" {{ $profile->country == 'Togo' ? 'selected' : '' }}>Togo</option>
                                <option value="Tokelau" {{ $profile->country == 'Tokelau' ? 'selected' : '' }}>Tokelau</option>
                                <option value="Tonga" {{ $profile->country == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                <option value="Trinidad and Tobago" {{ $profile->country == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                <option value="Tunisia" {{ $profile->country == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                <option value="Turkey" {{ $profile->country == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                <option value="Turkmenistan" {{ $profile->country == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                <option value="Turks and Caicos Islands" {{ $profile->country == 'Turks and Caicos Islands' ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                <option value="Tuvalu" {{ $profile->country == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                <option value="Uganda" {{ $profile->country == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                <option value="Ukraine" {{ $profile->country == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                <option value="United Arab Emirates" {{ $profile->country == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                <option value="United Kingdom" {{ $profile->country == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="United States" {{ $profile->country == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="Uruguay" {{ $profile->country == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                <option value="Uzbekistan" {{ $profile->country == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                <option value="Vanuatu" {{ $profile->country == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                <option value="Venezuela" {{ $profile->country == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                <option value="Viet Nam" {{ $profile->country == 'Viet Nam' ? 'selected' : '' }}>Viet Nam</option>
                                <option value="Virgin Islands, British" {{ $profile->country == 'Virgin Islands, British' ? 'selected' : '' }}>Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S." {{ $profile->country == 'Virgin Islands, U.S.' ? 'selected' : '' }}>Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna" {{ $profile->country == 'Wallis and Futuna' ? 'selected' : '' }}>Wallis and Futuna</option>
                                <option value="Western Sahara" {{ $profile->country == 'Western Sahara' ? 'selected' : '' }}>Western Sahara</option>
                                <option value="Yemen" {{ $profile->country == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                <option value="Zambia" {{ $profile->country == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                <option value="Zimbabwe" {{ $profile->country == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="city">City</label>
                            <input type="text"  class="form-control" name="city" value="{{  $profile->city ?? '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" href="javascript:void(0)" class="btn btn-primary w-100">Save</button>
                    </div>
                
            </div>
        </div>
    </div>
</form>
<div class="row">   
    @if ($profile->role == 'tutor' || $profile->role == 'mentor') 
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Payout Details</div>
                </div>
                <div class="card-body">
                    <form class="form-style1" action="{{ route('add.bank') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <div class="">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" value="{{ Auth::user()->bank->bank_name ?? ''  }}" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="">
                                    <label class="form-label">Bank Account Number</label>
                                    <input type="text" class="form-control" name="bank_account_number" value="{{ Auth::user()->bank->bank_account_number ?? ''  }}" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="">
                                    <label class="form-label">Bank Account Holder Name</label>
                                    <input type="text" class="form-control" name="bank_account_name" value="{{ Auth::user()->bank->bank_account_name ?? ''  }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-start">
                                    <button type="submit" class="btn btn-primary">Save Detail<i class="fal fa-arrow-right-long"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif    
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Change Password</div>
            </div>
            <div class="card-body">
                <form class="form-style1" action="{{ route('profile.update.password', $profile->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 mb-4">
                            <div class="mb20">
                                <label class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="********">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-4">
                            <div class="mb20">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" placeholder="********">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <div class="mb20">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="********">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="text-start">
                                <button class="btn btn-primary" type="submit">Change Password<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Delete Account</div>
            </div>
            <form action="{{ route('user.destroy') }}" method="POST" class="form-style1">
                @csrf
                @method('DELETE')
                <div class="card-body">
                    <p class="text">Warning: If you close your account, you will be unsubscribed from all your courses, and will lose access forever.</p>
                    <div class="mb-3">
                        <label class="heading-color ff-heading fw500 mb10">Enter Password</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" href="javascript:void(0)" class="btn btn-primary">Deactivate</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    document.getElementById('file').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const profileImage = document.getElementById('profileImage');
            profileImage.src = URL.createObjectURL(file);
        }
    });

</script>
 <script>
    function getDateTime() {
        var now     = new Date();
        var year    = now.getFullYear();
        var month   = now.getMonth()+1;
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds();
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }
        var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;
         return dateTime;
    }
    
    // example usage: realtime clock 
    setInterval(function(){
        currentTime = getDateTime();
        document.getElementById("digital-clock").innerHTML = currentTime;
    }, 1000); 
 </script>

 <script>
    // education and work experince if the year current then display present instead of year
    var currentYear = new Date().getFullYear();
    var year = document.querySelectorAll('.year');
    year.forEach(function(item){
        if(item.innerHTML == currentYear){
            item.innerHTML = 'Present';
        }
    });
 </script>
@endpush
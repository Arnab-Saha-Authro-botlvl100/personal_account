<x-app-layout>
    <style>
        @media (min-width: 769px) {
            #main-content {
                margin-left: 150px;
                /* Match the width of the sidebar */
                transition: 0.3s;
                /* Smooth transition for margin */
                padding: 20px;
                /* Optional: Add padding for better spacing */
            }

            /* When sidebar is collapsed */
            .collapsed #main-content {
                margin-left: 80px;
                /* Match the collapsed sidebar width */
            }
        }
    </style>
    <!-- Custom Styles -->

    <style>
        /* Button styling */
        #add-customer-button {
            width: 100%;
            /* Make the button full width on mobile */
            max-width: 200px;
            /* Limit the button width on larger screens */
            padding: 10px 15px;
            box-sizing: border-box;
            /* Ensure padding is included in width */
        }

        /* Media query for mobile devices */
        @media (max-width: 768px) {
            #customer-form {
                padding: 15px;
                /* Reduce padding for smaller screens */
            }

            #add-customer-button {
                max-width: 100%;
                /* Make the button full width on mobile */
            }
        }

        /* Add more responsiveness for larger screen sizes */
        @media (min-width: 992px) {
            #customer-form {
                padding: 30px;
                /* Add more padding for larger screens */
            }

            #add-customer-button {
                max-width: 250px;
                /* Adjust button width for larger screens */
            }
        }
    </style>

<style>
    @media (max-width: 800px) {

        #contentdiv{
            width: 100%!important;
        }
        /* Make the table a block layout for mobile */
        .table-responsive table,
        .table-responsive thead,
        .table-responsive tbody,
        .table-responsive th,
        .table-responsive td,
        .table-responsive tr {
            display: block;
        }

        /* Hide the table header on mobile */
        .table-responsive thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        /* Style each row as a block */
        .table-responsive tr {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        /* Style each cell as a block with left-aligned label and right-aligned data */
        .table-responsive td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%; /* Space for the label */
            text-align: right!important; /* Align data to the right */
            font-size: 12px; /* Decrease font size */
        }

        /* Style the data-label (left side) */
        .table-responsive td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%; /* Width of the label */
            padding-right: 10px;
            white-space: nowrap;
            content: attr(data-label);
            font-weight: bold;
            text-align: left!important; /* Align label to the left */
            font-size: 12px; /* Decrease font size */
        }

        /* Adjust badge size for mobile */
        .table-responsive .badge {
            font-size: 10px; /* Decrease badge font size */
            padding: 0.25rem 0.5rem; /* Adjust badge padding */
        }

        /* Adjust button size for mobile */
        .table-responsive .btn-sm {
            padding: 0.25rem 0.5rem; /* Decrease button padding */
            font-size: 10px; /* Decrease button font size */
        }
    }
</style>

    <!-- Add this in the head section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('layouts.links')



    <!-- Success Message -->
    @if (session('success'))
        <script>
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            );
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            );
        </script>
    @endif


    <div id="message" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
        <!-- Validation Errors -->
        @if ($errors->any())
            <div style="background-color: #f44336;" class="shadow-lg rounded p-4 text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class="col-md-12 col-sm-12" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" id="contentdiv" style="width: 85%;">
            <div class="container-fluid" id="initial-div">
                <div class="mt-4">
                    <div>
                        <button type="button" id="add-customer-button" class="btn btn-primary">Add New
                            Customer</button>
                    </div>
                </div>

                <!-- Customer Form -->
                <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data"
                    class="mx-auto mt-3 shadow-lg p-3 mb-5 bg-body rounded" id="customer-form"
                    style="max-width: 800px; width: 100%; padding: 20px; margin-left: 10px;">

                    @csrf

                    <input type="hidden" name="customer_id" value="{{ $customer_id }}" />

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone_number" id="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender </label>
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="agent_contract">Agent Contract <span class="text-danger">*</span></label>
                                <input type="number" name="agent_contract" id="agent_contract"
                                    class="form-control @error('agent_contract') is-invalid @enderror"
                                    value="{{ old('agent_contract') }}" required>
                                @error('agent_contract')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="supplier_contract">Supplier Contract </label>
                                <input type="number" name="supplier_contract" id="supplier_contract"
                                    class="form-control @error('supplier_contract') is-invalid @enderror"
                                    value="{{ old('supplier_contract') }}">
                                @error('supplier_contract')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="passport_file">Passport File </label>
                                <input type="file" name="passport_file" id="passport_file"
                                    class="form-control @error('passport_file') is-invalid @enderror">
                                @error('passport_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nid_file">Picture </label>
                                <input type="file" name="nid_file" id="nid_file"
                                    class="form-control @error('nid_file') is-invalid @enderror">
                                @error('nid_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="passport_number">Passport Number <span class="text-danger">*</span></label>
                                <input type="text" name="passport_number" id="passport_number"
                                    class="form-control
                                @error('passport_number') is-invalid @enderror"
                                    value="{{ old('passport_number') }}" maxlength="13" required>
                                @error('passport_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="agent">Agent <span class="text-danger">*</span></label>
                                <select name="agent" id="agent"
                                    class="form-control @error('agent') is-invalid @enderror select2" required>
                                    <option value="">Select an agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                @error('agent')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="supplier">Supplier </label>
                                <select name="supplier" id="supplier"
                                    class="form-control @error('supplier') is-invalid @enderror select2">
                                    <option value="">Select an supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="agent">Service <span class="text-danger">*</span></label>
                                <select name="service" id="service"
                                    class="form-control @error('service') is-invalid @enderror select2" required>
                                    <option value="">Select a service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="country_of_residence">Target Country </label>
                                <select name="country_of_residence" id="country_of_residence"
                                    class=" form-control @error('country_of_residence') is-invalid @enderror select2">
                                    <option value="">Select Country</option>
                                    <option value="">Select Country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
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
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cabo Verde">Cabo Verde</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czechia">Czechia</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Eswatini">Eswatini</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Holy See">Holy See</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestine State">Palestine State</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States of America">United States of America</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City">Vatican City</option>
                                </select>
                                @error('country_of_residence')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="address_line_1">Address </label>
                                <input type="text" name="address_line_1" id="address_line_1"
                                    class="form-control @error('address_line_1') is-invalid @enderror"
                                    value="{{ old('address_line_1') }}">
                                @error('address_line_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">
                
                                </textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" id="cancel-customer-button" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>

                <div class="container-fluid">
                    @if ($customers->isEmpty())
                        <div class="alert alert-info">No customers found.</div>
                    @else
                        <div class="mx-auto mt-4">
                            <div class="card shadow-lg">
                                <div class="card-header bg-info text-white text-center">
                                    <h5 class="mb-0">Customers</h5>
                                </div>
                                <div class="card-body mx-auto">
                                    <div class="table-responsive"> <!-- Add this wrapper -->
                                        <table class="table table-hover table-bordered text-center align-middle"
                                            id="customer-table">
                                            <thead class="table-dark">
                                                <tr class="align-items-center">
                                                    <th scope="col" style="width: 7%;">Customer ID</th>
                                                    <th scope="col" style="width: 10%;">Creation Date</th>
                                                    <th scope="col" style="width: 20%;">Customer Information</th>
                                                    <th scope="col" style="width: 10%;">Service</th>
                                                    <th scope="col" style="width: 10%;">Supplier Name</th>
                                                    <th scope="col" style="width: 10%;">Agent Name</th>
                                                    <th scope="col" style="width: 10%;">Phone Number</th>
                                                    <th scope="col" style="width: 10%;">Contract <br> Information
                                                    </th>
                                                    <th scope="col" style="width: 25%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $customer)
                                                    <tr class="align-items-center justify-content-center">
                                                        <td class="fw-bold text-center" data-label="Customer ID">
                                                            {{ $customer->customer_id }}</td>
                                                        <td class="text-center" data-label="Date">
                                                            {{ $customer->created_at }}</td>
                                                        <td class="text-start text-center"
                                                            data-label="Customer">
                                                            <strong>{{ $customer->name }}</strong><br>
                                                            Passport: {{ $customer->passport_number }}<br>
                                                            Gender: {{ $customer->gender }}
                                                        </td>
                                                        <td class="text-center" data-label="Service">
                                                            {{ $customer->service_name ?? 'N/A' }}</td>
                                                        <td class="text-center" data-label="Supplier">
                                                            {{ $customer->supplier_name ?? 'N/A' }}</td>
                                                        <td class="text-center" data-label="Agent">
                                                            {{ $customer->agent_name ?? 'N/A' }}</td>
                                                        <td class="text-center" data-label="Phone">
                                                            {{ $customer->phone_number }}</td>
                                                        <td data-label="Contract">
                                                            @if ($customer->invoice_no)
                                                                <span
                                                                    class="badge bg-success text-white p-2 mt-3 fw-bold fs-4">{{ $customer->invoice_no }}</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-danger text-white mt-3 p-2 fw-bold fs-4">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="p-2 text-center" data-label="">
                                                            <!-- View Button -->
                                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewModal-{{ $customer->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <!-- Edit Button -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal-{{ $customer->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <!-- Delete Button -->
                                                            <form
                                                                action="{{ route('customers.destroy', $customer->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger">Delete</button>
                                                            </form>
                                                            <!-- WhatsApp Button -->
                                                            <a href="https://wa.me/+88{{ $customer->phone_number }}"
                                                                target="_blank"
                                                                class="btn btn-sm btn-outline-success">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                            <!-- Contract Button -->
                                                            @if ($customer->contract_id == null)
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-sm btn-outline-warning"
                                                                    id="contractButton"
                                                                    data-agent="{{ $customer->agent_name }}"
                                                                    data-supplier="{{ $customer->supplier_name }}"
                                                                    data-customer-id="{{ $customer->customer_id }}"
                                                                    data-customer-actual-id="{{ $customer->id }}"
                                                                    data-agent-amount="{{ $customer->agent_contract }}"
                                                                    data-supplier-amount="{{ $customer->supplier_contract }}">
                                                                    <i class="fa-solid fa-file-contract"></i>
                                                                </a>
                                                            @endif
                                                            <!-- Personal Info Button -->
                                                            <button type="button" class="btn btn-sm btn-outline-info"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#customer_details_Modal-{{ $customer->id }}">
                                                                <i class="fa-solid fa-person"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <!-- Contract Confirmation Modal -->
                            <div class="modal fade" id="contractModal" tabindex="-1"
                                aria-labelledby="contractModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="contractModalLabel">Confirm Contract</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body (Card Layout) -->
                                        <div class="modal-body">
                                            <div class="card shadow-lg rounded-3">
                                                <div class="card-body">
                                                    <input type="hidden" name="customer_id" id="customer_id">
                                                    <!-- Agent -->
                                                    <div class="mb-3">
                                                        <p><strong>Agent:</strong> <span id="modal-agent"></span></p>
                                                    </div>
                                                    <!-- Supplier -->
                                                    <div class="mb-3">
                                                        <p><strong>Supplier:</strong> <span id="modal-supplier"></span>
                                                        </p>
                                                    </div>
                                                    <!-- Customer ID -->
                                                    <div class="mb-3">
                                                        <p><strong>Customer ID:</strong> <span
                                                                id="modal-customer-id"></span></p>
                                                    </div>
                                                    <!-- Agent Amount -->
                                                    <div class="mb-3">
                                                        <p><strong>Agent Amount:</strong> <span
                                                                id="modal-agent-amount"></span></p>
                                                    </div>
                                                    <!-- Supplier Amount -->
                                                    <div class="mb-3">
                                                        <p><strong>Supplier Amount:</strong> <span
                                                                id="modal-supplier-amount"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                id="close-contract">Close</button>
                                            <button type="button" class="btn btn-success"
                                                id="confirm-contract">Confirm Contract</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Edit Modals and view modals (Placed Outside the Table) -->
                            @foreach ($customers as $customer)
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal-{{ $customer->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel-{{ $customer->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel-{{ $customer->id }}">Edit
                                                    <b class="fw-bold">{{ $customer->name }}</b>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Edit Form -->
                                                <form action="{{ route('customers.update', $customer->id) }}"
                                                    method="POST" enctype="multipart/form-data"
                                                    class="container mx-auto mt-3 shadow-lg p-3 mb-5 bg-body rounded"
                                                    id="customer-form">
                                                    @csrf
                                                    <input type="hidden" name="customer_id"
                                                        value="{{ $customer->customer_id }}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Full Name -->
                                                            <div class="form-group">
                                                                <label for="name">Full Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    value="{{ old('name', $customer->name) }}"
                                                                    required>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Phone Number -->
                                                            <div class="form-group">
                                                                <label for="phone_number">Phone Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="tel" name="phone_number"
                                                                    id="phone_number"
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    value="{{ old('phone_number', $customer->phone_number) }}"
                                                                    required>
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Gender -->
                                                            <div class="form-group">
                                                                <label for="gender">Gender </label>
                                                                <select name="gender" id="gender"
                                                                    class="form-control @error('gender') is-invalid @enderror">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male"
                                                                        {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>
                                                                        Male</option>
                                                                    <option value="Female"
                                                                        {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>
                                                                        Female</option>
                                                                    <option value="Other"
                                                                        {{ old('gender', $customer->gender) == 'Other' ? 'selected' : '' }}>
                                                                        Other</option>
                                                                </select>
                                                                @error('gender')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Agent Contract -->
                                                            <div class="form-group">
                                                                <label for="agent_contract">Agent Contract <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="agent_contract"
                                                                    id="agent_contract"
                                                                    class="form-control @error('agent_contract') is-invalid @enderror"
                                                                    value="{{ old('agent_contract', $customer->agent_contract) }}"
                                                                    required>
                                                                @error('agent_contract')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Supplier Contract -->
                                                            <div class="form-group">
                                                                <label for="supplier_contract">Supplier
                                                                    Contract</label>
                                                                <input type="number" name="supplier_contract"
                                                                    id="supplier_contract"
                                                                    class="form-control @error('supplier_contract') is-invalid @enderror"
                                                                    value="{{ old('supplier_contract', $customer->supplier_contract) }}">
                                                                @error('supplier_contract')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>



                                                            <!-- Note -->
                                                            <div class="form-group">
                                                                <label for="note">Note</label>
                                                                <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $customer->note) }}</textarea>
                                                                @error('note')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Passport File -->
                                                            <div class="form-group d-flex">
                                                                <div>
                                                                    <label for="passport_file">Passport File </label>
                                                                    <input type="file" name="passport_file"
                                                                        id="passport_file"
                                                                        class="form-control @error('passport_file') is-invalid @enderror">
                                                                    @error('passport_file')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Display current passport file as an image -->
                                                                @if ($customer->passport_file)
                                                                    <div class="mt-2">
                                                                        <small class="text-muted">Current file:</small>
                                                                        <img src="{{ asset('storage/' . $customer->passport_file) }}"
                                                                            alt="Passport File"
                                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                                    </div>
                                                                @else
                                                                    <div class="mt-2">
                                                                        <small class="text-muted">No passport file
                                                                            uploaded.</small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Passport Number -->
                                                            <div class="form-group">
                                                                <label for="passport_number">Passport Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="passport_number"
                                                                    id="passport_number"
                                                                    class="form-control @error('passport_number') is-invalid @enderror"
                                                                    value="{{ old('passport_number', $customer->passport_number) }}"
                                                                    maxlength="13" required>
                                                                @error('passport_number')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Agent -->
                                                            <div class="form-group">
                                                                <label for="agent">Agent <span
                                                                        class="text-danger">*</span></label>
                                                                <select name="agent" id="agent"
                                                                    class="form-control @error('agent') is-invalid @enderror select2"
                                                                    required>
                                                                    <option value="">Select an agent</option>
                                                                    @foreach ($agents as $agent)
                                                                        <option value="{{ $agent->id }}"
                                                                            {{ old('agent', $customer->agent) == $agent->id ? 'selected' : '' }}>
                                                                            {{ $agent->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('agent')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Supplier -->
                                                            <div class="form-group">
                                                                <label for="supplier">Supplier</label>
                                                                <select name="supplier" id="supplier"
                                                                    class="form-control @error('supplier') is-invalid @enderror select2">
                                                                    <option value="">Select a supplier</option>
                                                                    @foreach ($suppliers as $supplier)
                                                                        <option value="{{ $supplier->id }}"
                                                                            {{ old('supplier', $customer->supplier) == $supplier->id ? 'selected' : '' }}>
                                                                            {{ $supplier->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('supplier')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Service -->
                                                            <div class="form-group">
                                                                <label for="service">Service</label>
                                                                <select name="service" id="service"
                                                                    class="form-control @error('service') is-invalid @enderror select2">
                                                                    <option value="">Select a service</option>
                                                                    @foreach ($services as $service)
                                                                        <option value="{{ $service->id }}"
                                                                            {{ old('service', $customer->service) == $service->id ? 'selected' : '' }}>
                                                                            {{ $service->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('service')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="country_of_residence">Target Country
                                                                </label>
                                                                <select name="country_of_residence"
                                                                    id="country_of_residence"
                                                                    class="form-control @error('country_of_residence') is-invalid @enderror select2">
                                                                    <option value="">Select Country</option>
                                                                    @foreach ([
        'Afghanistan',
        'Albania',
        'Algeria',
        'Andorra',
        'Angola',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegovina',
        'Botswana',
        'Brazil',
        'Brunei',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cabo Verde',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Colombia',
        'Comoros',
        'Congo',
        'Costa Rica',
        'Côte d\'Ivoire',
        'Croatia',
        'Cuba',
        'Cyprus',
        'Czechia',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Eswatini',
        'Ethiopia',
        'Fiji',
        'Finland',
        'France',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Greece',
        'Grenada',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Holy See',
        'Honduras',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran',
        'Iraq',
        'Ireland',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Kuwait',
        'Kyrgyzstan',
        'Laos',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Mauritania',
        'Mauritius',
        'Mexico',
        'Micronesia',
        'Moldova',
        'Monaco',
        'Mongolia',
        'Montenegro',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'North Korea',
        'North Macedonia',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Palestine State',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Poland',
        'Portugal',
        'Qatar',
        'Romania',
        'Russia',
        'Rwanda',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Vincent and the Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Serbia',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Korea',
        'South Sudan',
        'Spain',
        'Sri Lanka',
        'Sudan',
        'Suriname',
        'Sweden',
        'Switzerland',
        'Syria',
        'Tajikistan',
        'Tanzania',
        'Thailand',
        'Timor-Leste',
        'Togo',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States of America',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Vatican City',
    ] as $country)
                                                                        <option value="{{ $country }}"
                                                                            {{ old('country_of_residence', $customer->country_of_residence) == $country ? 'selected' : '' }}>
                                                                            {{ $country }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('country_of_residence')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>


                                                            <!-- Address Line 1 -->
                                                            <div class="form-group">
                                                                <label for="address_line_1">Address </label>
                                                                <input type="text" name="address_line_1"
                                                                    id="address_line_1"
                                                                    class="form-control @error('address_line_1') is-invalid @enderror"
                                                                    value="{{ old('address_line_1', $customer->address_line_1) }}">
                                                                @error('address_line_1')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- NID File -->
                                                            <div class="form-group">
                                                                <div>
                                                                    <label for="nid_file">Picture </label>
                                                                    <input type="file" name="nid_file"
                                                                        id="nid_file"
                                                                        class="form-control @error('nid_file') is-invalid @enderror">
                                                                    @error('nid_file')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Display current NID file as an image -->
                                                                @if ($customer->nid_file)
                                                                    <div class="mt-2">
                                                                        <small class="text-muted">Current file:</small>
                                                                        <img src="{{ asset('storage/' . $customer->nid_file) }}"
                                                                            alt="NID File"
                                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                                    </div>
                                                                @else
                                                                    <div class="mt-2">
                                                                        <small class="text-muted">No NID file
                                                                            uploaded.</small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Form Buttons -->
                                                    <div class="d-flex justify-content-between">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal-{{ $customer->id }}" tabindex="-1"
                                    aria-labelledby="viewModalLabel-{{ $customer->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel-{{ $customer->id }}">
                                                    Customer Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Customer Details Card -->
                                                <div class="card shadow-lg">
                                                    <div class="card-header bg-info text-white">
                                                        <h5 class="card-title mb-0">{{ $customer->name }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!-- Left Column -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <strong>Customer ID:</strong>
                                                                    {{ $customer->customer_id }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Phone Number:</strong>
                                                                    {{ $customer->phone_number }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Gender:</strong> {{ $customer->gender }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Passport Number:</strong>
                                                                    {{ $customer->passport_number }}
                                                                </div>

                                                                <div class="mb-3">
                                                                    <strong>Supplier:</strong>
                                                                    {{ $customer->supplier_name ?? 'N/A' }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Service:</strong>
                                                                    {{ $customer->service_name ?? 'N/A' }}
                                                                </div>

                                                                <!-- Passport File -->
                                                                <div class="mb-3">
                                                                    <strong>Passport File:</strong>
                                                                    @if ($customer->passport_file)
                                                                        <div class="mt-2">
                                                                            <img src="{{ asset('storage/' . $customer->passport_file) }}"
                                                                                alt="Passport File"
                                                                                style="width: 100px; height: 100px; object-fit: cover;">

                                                                            <!-- View Button -->
                                                                            <a href="{{ asset('storage/' . $customer->passport_file) }}"
                                                                                target="_blank"
                                                                                class="btn btn-sm btn-outline-primary m-2">
                                                                                <i class="fas fa-eye"></i> View
                                                                            </a>

                                                                            <!-- Download Button -->
                                                                            <a href="{{ asset('storage/' . $customer->passport_file) }}"
                                                                                download
                                                                                class="btn btn-sm btn-outline-success m-2">
                                                                                <i class="fas fa-download"></i>
                                                                                Download
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="mt-2">
                                                                            <small class="text-muted">No passport file
                                                                                uploaded.</small>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <!-- Right Column -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <strong>Country of Residence:</strong>
                                                                    {{ $customer->country_of_residence ?? 'N/A' }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Address:</strong>
                                                                    {{ $customer->address_line_1 ?? 'N/A' }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Country:</strong>
                                                                    {{ $customer->country ?? 'N/A' }}
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong>Note:</strong>
                                                                    {{ $customer->note ?? 'N/A' }}
                                                                </div>

                                                                <div class="mb-3">
                                                                    <strong>Agent:</strong>
                                                                    {{ $customer->agent_name ?? 'N/A' }}
                                                                </div>
                                                                <!-- NID File -->
                                                                <div class="mb-3">
                                                                    <strong>Picture:</strong>
                                                                    @if ($customer->nid_file)
                                                                        <div class="mt-2">
                                                                            <img src="{{ asset('storage/' . $customer->nid_file) }}"
                                                                                alt="NID File"
                                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                                            <!-- View Button -->
                                                                            <a href="{{ asset('storage/' . $customer->nid_file) }}"
                                                                                target="_blank"
                                                                                class="btn btn-sm btn-outline-primary m-2">
                                                                                <i class="fas fa-eye"></i> View
                                                                            </a>
                                                                            <!-- Download Button -->
                                                                            <a href="{{ asset('storage/' . $customer->nid_file) }}"
                                                                                download
                                                                                class="btn btn-sm btn-outline-success m-2">
                                                                                <i class="fas fa-download"></i>
                                                                                Download
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="mt-2">
                                                                            <small class="text-muted">No PHOTO file
                                                                                uploaded.</small>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Customer Details Modal -->
                                <div class="modal fade" id="customer_details_Modal-{{ $customer->id }}"
                                    tabindex="-1" aria-labelledby="customerDetailsLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title" id="customerDetailsLabel">Customer Details
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('customer.details.store', $customer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <!-- Left Column -->
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Passport Issue Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="passport_issue_date"
                                                                    value="{{ old('passport_issue_date', $customer->passport_issue_date) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="passport_expiry_date">Passport Expiry Date
                                                                </label>
                                                                <input type="date" class="form-control"
                                                                    name="passport_expiry_date"
                                                                    value="{{ old('passport_expiry_date', $customer->passport_expiry_date) }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Date of Birth</label>
                                                                <input type="date" class="form-control"
                                                                    name="date_of_birth"
                                                                    value="{{ old('date_of_birth', $customer->date_of_birth) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Medical Name</label>
                                                                <input type="text" class="form-control"
                                                                    name="medical_name"
                                                                    value="{{ old('medical_name', $customer->medical_name) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Medical Issue Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="medical_issue_date"
                                                                    value="{{ old('medical_issue_date', $customer->medical_issue_date) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Medical Status</label>
                                                                <select class="form-control" name="medical_status">
                                                                    <option value="fit"
                                                                        {{ old('medical_status', $customer->medical_status) == 'fit' ? 'selected' : '' }}>
                                                                        Fit</option>
                                                                    <option value="unfit"
                                                                        {{ old('medical_status', $customer->medical_status) == 'unfit' ? 'selected' : '' }}>
                                                                        Unfit</option>
                                                                    <option value="pending"
                                                                        {{ old('medical_status', $customer->medical_status) == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">MOFA No</label>
                                                                <input type="text" class="form-control"
                                                                    name="mofa_no"
                                                                    value="{{ old('mofa_no', $customer->mofa_no) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">MOFA Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="mofa_date"
                                                                    value="{{ old('mofa_date', $customer->mofa_date) }}">
                                                            </div>
                                                        </div>

                                                        <!-- Right Column -->
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Biometrics Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="biomatrics_date"
                                                                    value="{{ old('biomatrics_date', $customer->biomatrics_date) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Biometric Status</label>
                                                                <select class="form-control" name="biometric_status">
                                                                    <option value="done"
                                                                        {{ old('biometric_status', $customer->biomatric_status) == 'done' ? 'selected' : '' }}>
                                                                        Done</option>
                                                                    <option value="pending"
                                                                        {{ old('biometric_status', $customer->biomatric_status) == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Police Clearance No</label>
                                                                <input type="text" class="form-control"
                                                                    name="police_clearance_no"
                                                                    value="{{ old('police_clearance_no', $customer->police_clearance_no) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Visa No</label>
                                                                <input type="text" class="form-control"
                                                                    name="visa_no"
                                                                    value="{{ old('visa_no', $customer->visa_no) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Training Info</label>
                                                                <input type="text" class="form-control"
                                                                    name="trainig_info"
                                                                    value="{{ old('trainig_info', $customer->training_info) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Visa Stamping Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="visa_stemping_date"
                                                                    value="{{ old('visa_stemping_date', $customer->visa_stemping_date) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">BMET Finger</label>
                                                                <input type="date" class="form-control"
                                                                    name="bmet_finger"
                                                                    value="{{ old('bmet_finger', $customer->bmet_finger) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Manpower Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="manpower_date"
                                                                    value="{{ old('manpower_date', $customer->manpower_date) }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        // Show the message container
        const message = document.getElementById('message');
        if (message) {
            message.style.display = 'block';

            // Hide the message after 3 seconds
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        }

        $(document).ready(function() {

            $('#contractButton').on('click', function() {
                var agent = $(this).data('agent');
                var supplier = $(this).data('supplier');
                var customerId = $(this).data('customer-id');
                var id = $(this).data('customer-actual-id');
                var agentAmount = $(this).data('agent-amount');
                var supplierAmount = $(this).data('supplier-amount');

                // Populate the modal with the values
                $('#modal-agent').text(agent);
                $('#modal-supplier').text(supplier);
                $('#modal-customer-id').text(customerId);
                $('#modal-agent-amount').text(agentAmount);
                $('#modal-supplier-amount').text(supplierAmount);
                $('#customer_id').val(id);
                // Show the modal
                $('#contractModal').modal('show');
            });

            // Handle contract confirmation
            $('#confirm-contract').on('click', function() {
                let customerId = $('#customer_id').val(); // Get customer_id from the hidden input or form

                $.ajax({
                    url: '/contracts/create/' +
                        customerId, // Use the correct route with customer_id
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF Token for security
                        id: customerId
                    },
                    success: function(response) {
                        // Handle success (e.g., show a success message)
                        Swal.fire(
                            'Confirmed!',
                            'The contract has been created.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Reload the page after confirmation
                                location.reload(); // This will reload the page
                            }
                        });
                        $('#contractModal').modal('hide'); // Close the modal
                    },
                    error: function(xhr, status, error) {
                        // Handle error (e.g., show an error message)
                        Swal.fire(
                            'Error!',
                            'An error occurred while confirming the contract.',
                            'error'
                        );
                    }
                });
            });


            $('#close-contract').click(function() {
                Swal.fire(
                    'Error!',
                    'Contract is not confiremd.',
                    'error'
                );
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({
                // Optional configurations
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: false, // Enable column sorting
                info: true // Display table information
            });
            $("#customer-form").hide();
            $("#add-customer-button").click(function() {
                $("#customer-form").show('2');
                $(this).hide();
            });

            $("#cancel-customer-button").click(function() {
                $("#customer-form").hide('2');
                $("#add-customer-button").show('2');
            });

            $('.view-customer').click(function(event) {
                event.preventDefault();
                const customerId = $(this).data('customer-id');
                const modalBody = $('#customer-card-content');
                modalBody.html(
                    '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );
                $('#customerDetailsModal').modal('show');

                $.ajax({
                    url: "{{ route('customers.show', '') }}/" + customerId,
                    method: "GET",
                    success: function(response) {
                        const customer = response.data;
                        console.log(response.data);
                        const formatDate = (dateString) => {
                            if (!dateString) return 'N/A'; // Handle null or undefined dates
                            try {
                                const date = new Date(dateString);
                                return date
                                    .toLocaleDateString(); // Use locale-specific formatting
                                // Or, if you prefer a specific format, use:
                                // return date.toISOString().slice(0, 10); // YYYY-MM-DD
                            } catch (error) {
                                console.error("Error formatting date:", error);
                                return 'Invalid Date';
                            }
                        };
                        const formattedDateOfBirth = formatDate(customer.date_of_birth);
                        const formattedPassportExpiry = formatDate(customer
                            .passport_expiry_date);

                        let cardContent = `
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">${customer.first_name} ${customer.middle_name ? customer.middle_name + ' ' : ''}${customer.last_name}</h5>
                                    <p class="card-text"><strong>Email:</strong> ${customer.email}</p>
                                    <p class="card-text"><strong>Phone:</strong> ${customer.phone_number}</p>
                                    <p class="card-text"><strong>Date of Birth:</strong> ${formattedDateOfBirth}</p>
                                    <p class="card-text"><strong>Gender:</strong> ${customer.gender}</p>
                                    <p class="card-text"><strong>Marital Status:</strong> ${customer.marital_status ? customer.marital_status : 'N/A'}</p>
                                    <p class="card-text"><strong>Occupation:</strong> ${customer.occupation ? customer.occupation : 'N/A'}</p>
                                    <p class="card-text"><strong>Employer:</strong> ${customer.employer ? customer.employer : 'N/A'}</p>
                                    <p class="card-text"><strong>Emergency Contact:</strong> ${customer.emergency_contact_name} (${customer.emergency_contact_relationship}), ${customer.emergency_contact_phone}</p>
                                    <div class="me-2">
                                        <strong>Passport:</strong><br>
                                        ${customer.passport_file_url ? `<img src="${customer.passport_file}" alt="Passport" class="img-thumbnail" width="200">` : 'N/A'}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Nationality:</strong> ${customer.nationality}</p>
                                    <p class="card-text"><strong>Passport Number:</strong> ${customer.passport_number}</p>
                                    <p class="card-text"><strong>Passport Expiry:</strong> ${formattedPassportExpiry}</p>
                                    <p class="card-text"><strong>Country of Residence:</strong> ${customer.country_of_residence}</p>
                                    <p class="card-text"><strong>Address:</strong> ${customer.address_line_1} ${customer.address_line_2 ? ', ' + customer.address_line_2 : ''}, ${customer.city}, ${customer.state ? customer.state + ', ' : ''}${customer.postal_code}, ${customer.country}</p>
                                    <div class="me-2">
                                       <div>
                                            <strong>NID:</strong><br>
                                            ${customer.nid_file_url ? `<img src="${customer.nid_file_url}" alt="NID" class="img-thumbnail" width="200">` : 'N/A'}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        modalBody.html(cardContent);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching customer details:", error);
                        console.log(xhr.responseText);
                        modalBody.html(
                            "<div class='alert alert-danger'>Error loading details.</div>");
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#agent').select2({
                placeholder: "Select an agent",
                allowClear: true
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to delete this customer?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

</x-app-layout>

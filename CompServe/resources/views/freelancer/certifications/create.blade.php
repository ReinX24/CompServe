<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li><a href="{{ route('freelancer.certifications.index') }}"
                    class="hover:text-primary">Certifications</a></li>
            <li class="text-primary font-semibold">Create Certification</li>
        </ul>
    </div>

    <div class="container mx-auto max-w-xl p-6">

        {{-- GLOBAL ERROR ALERT --}}
        @if ($errors->any())
            <div class="alert alert-error mb-4 flex flex-col space-y-2">
                <span class="font-semibold">There were some issues with your
                    submission:</span>

                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body space-y-4">

                <h1 class="text-3xl font-bold">Apply for Certification</h1>
                <p class="text-sm text-base-content/70">Submit your
                    certification
                    details below.</p>

                <form action="{{ route('freelancer.certifications.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Certification Type -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold">Certification
                                Type</span>
                        </label>
                        <select name="type"
                            id="cert-type"
                            class="select select-bordered w-full"
                            required>
                            <option value="">Select Certification</option>

                            <optgroup label="TESDA National Certificates">
                                <option value="NC I">NC I</option>
                                <option value="NC II">NC II</option>
                                <option value="NC III">NC III</option>
                                <option value="NC IV">NC IV</option>
                            </optgroup>

                            <optgroup label="IT & Tech Certifications">
                                <option value="CompTIA A+">CompTIA A+</option>
                                <option value="CompTIA Network+">CompTIA
                                    Network+</option>
                                <option value="CompTIA Security+">CompTIA
                                    Security+</option>
                                <option value="Cisco CCNA">Cisco CCNA (Certified
                                    Network Associate)</option>
                                <option value="Cisco CCNP">Cisco CCNP (Certified
                                    Network Professional)</option>
                                <option value="Microsoft Azure Fundamentals">
                                    Microsoft Azure Fundamentals</option>
                                <option value="Microsoft Azure Administrator">
                                    Microsoft Azure Administrator</option>
                                <option
                                    value="AWS Certified Cloud Practitioner">AWS
                                    Certified Cloud Practitioner</option>
                                <option value="AWS Solutions Architect">AWS
                                    Solutions Architect</option>
                                <option value="Google Cloud Associate">Google
                                    Cloud Associate Engineer</option>
                                <option value="Oracle Certified Professional">
                                    Oracle Certified Professional</option>
                            </optgroup>

                            <optgroup label="Programming & Development">
                                <option value="Oracle Java Certification">Oracle
                                    Java Certification</option>
                                <option
                                    value="Microsoft Certified: Azure Developer">
                                    Microsoft Certified: Azure Developer
                                </option>
                                <option
                                    value="Certified Kubernetes Administrator">
                                    Certified Kubernetes Administrator (CKA)
                                </option>
                                <option value="Red Hat Certified Engineer">Red
                                    Hat Certified Engineer (RHCE)</option>
                                <option value="Salesforce Certified Developer">
                                    Salesforce Certified Developer</option>
                            </optgroup>

                            <optgroup label="Cybersecurity">
                                <option value="Certified Ethical Hacker">
                                    Certified Ethical Hacker (CEH)</option>
                                <option value="CISSP">CISSP (Certified
                                    Information Systems Security Professional)
                                </option>
                                <option value="CISM">CISM (Certified
                                    Information Security Manager)</option>
                                <option value="ISO 27001 Lead Auditor">ISO 27001
                                    Lead Auditor</option>
                            </optgroup>

                            <optgroup label="Data & Analytics">
                                <option value="Google Data Analytics">Google
                                    Data Analytics Professional Certificate
                                </option>
                                <option value="Microsoft Power BI">Microsoft
                                    Certified: Power BI Data Analyst</option>
                                <option value="Tableau Desktop Specialist">
                                    Tableau Desktop Specialist</option>
                                <option value="Cloudera Data Engineer">Cloudera
                                    Certified Data Engineer</option>
                            </optgroup>

                            <optgroup label="Project Management">
                                <option value="PMP">PMP (Project Management
                                    Professional)</option>
                                <option value="CAPM">CAPM (Certified Associate
                                    in Project Management)</option>
                                <option value="Scrum Master">Certified Scrum
                                    Master (CSM)</option>
                                <option value="Agile Certified Practitioner">PMI
                                    Agile Certified Practitioner (PMI-ACP)
                                </option>
                                <option value="PRINCE2">PRINCE2 Certification
                                </option>
                            </optgroup>

                            <optgroup label="Design & Creative">
                                <option value="Adobe Certified Professional">
                                    Adobe Certified Professional</option>
                                <option value="Google UX Design">Google UX
                                    Design Professional Certificate</option>
                                <option value="HubSpot Content Marketing">
                                    HubSpot Content Marketing Certification
                                </option>
                            </optgroup>

                            <optgroup label="Philippines-Specific">
                                <option value="DICT Digital Jobs PH">DICT
                                    Digital Jobs PH Certificate</option>
                                <option value="PhilNITS">PhilNITS (Philippine
                                    NITS Exam)</option>
                                <option value="PSITE Certification">PSITE IT
                                    Professional Certification</option>
                            </optgroup>

                            <option value="other">Other (Specify below)
                            </option>
                        </select>

                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Custom Certification Name (shown when "Other" is selected) -->
                    <div class="form-control space-y-2"
                        id="custom-cert-field"
                        style="display: none;">
                        <label class="label">
                            <span class="label-text font-semibold">Certification
                                Name</span>
                        </label>
                        <input type="text"
                            name="custom_certification"
                            id="custom-cert-input"
                            class="input input-bordered w-full"
                            placeholder="Enter certification name">

                        @error('custom_certification')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-control space-y-2">
                        <label class="label">
                            <span class="label-text font-semibold">Description
                                (optional)</span>
                        </label>
                        <textarea name="description"
                            class="textarea textarea-bordered w-full h-24"
                            placeholder="Add details or notes about your certification"></textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Upload Document -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold">Upload
                                Certification Document</span>
                        </label>
                        <input type="file"
                            name="document"
                            class="file-input file-input-bordered w-full"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required>
                        <p class="text-xs text-base-content/60">Accepted
                            formats: PDF, JPG, PNG (Max 5MB)</p>

                        @error('document')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Live File Preview -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span
                                class="label-text font-semibold">Preview</span>
                        </label>

                        <div id="file-preview"
                            class="border rounded-lg p-4 bg-base-200 text-center hidden">
                            <p class="text-base-content/70">No file selected.
                            </p>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="btn btn-primary w-full">Submit
                        Application</button>
                </form>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const certTypeSelect = document.getElementById('cert-type');
            const customCertField = document.getElementById(
                'custom-cert-field');
            const customCertInput = document.getElementById(
                'custom-cert-input');
            const fileInput = document.querySelector(
                'input[name="document"]');
            const previewBox = document.getElementById('file-preview');

            // Show custom field when "Other" is selected
            certTypeSelect.addEventListener('change', (e) => {
                if (e.target.value === 'other') {
                    customCertField.style.display = 'block';
                    customCertInput.required = true;
                } else {
                    customCertField.style.display = 'none';
                    customCertInput.required = false;
                    customCertInput.value = '';
                }
            });

            // Live File Preview
            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];

                if (!file) {
                    previewBox.classList.add('hidden');
                    return;
                }

                const fileType = file.type;
                previewBox.classList.remove('hidden');

                // Clear old preview
                previewBox.innerHTML = "";

                // Image preview
                if (fileType.startsWith("image/")) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className =
                        "max-h-48 mx-auto rounded-lg shadow";
                    previewBox.appendChild(img);
                }

                // PDF preview (filename only for security)
                else if (fileType === "application/pdf") {
                    const p = document.createElement('p');
                    p.textContent = "PDF Uploaded: " + file.name;
                    p.className = "font-semibold text-base-content";
                    previewBox.appendChild(p);
                } else {
                    previewBox.innerHTML =
                        "<p class='text-red-500'>Unsupported file format</p>";
                }
            });
        });
    </script>
</x-layouts.app>

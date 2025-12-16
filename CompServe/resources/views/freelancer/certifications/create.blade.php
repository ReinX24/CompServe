<x-layouts.app>
    <!-- Breadcrumbs with Enhanced Styling -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/70">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('freelancer.certifications.index') }}"
                    class="hover:text-primary transition-colors duration-200">
                    My Certifications
                </a>
            </li>
            <li class="text-primary font-semibold">Apply for Certification</li>
        </ul>
    </div>

    <!-- Hero Header with Gradient Background -->
    <div
        class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
            </div>
            <div
                class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
            </div>
        </div>

        <div class="relative p-8 md:p-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1
                    class="text-4xl md:text-5xl font-bold text-base-content mb-3 flex items-center justify-center gap-3">
                    <span class="text-5xl">📝</span>
                    Apply for Certification
                </h1>
                <p
                    class="text-base md:text-lg text-base-content/70">
                    Submit your certification details to enhance your professional profile ✨
                </p>
            </div>
        </div>
    </div>

    {{-- GLOBAL ERROR ALERT with Enhanced Styling --}}
    @if ($errors->any())
        <div class="mb-6 animate-fade-in">
            <div role="alert"
                class="alert bg-error/10 border-error/30 text-error shadow-lg rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="bg-error/20 p-2 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold block mb-2">There were some issues with your submission:</span>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="max-w-3xl mx-auto">
        <div class="card bg-base-100 shadow-xl border border-base-300/50 animate-fade-in-up">
            <div class="card-body p-8">

                <form action="{{ route('freelancer.certifications.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Certification Type -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Certification Type
                            </span>
                            <span class="label-text-alt text-error">*Required</span>
                        </label>
                        <select name="type"
                            id="cert-type"
                            class="select select-bordered w-full select-lg focus:select-primary transition-all duration-200"
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
                                <option value="CompTIA Network+">CompTIA Network+</option>
                                <option value="CompTIA Security+">CompTIA Security+</option>
                                <option value="Cisco CCNA">Cisco CCNA (Certified Network Associate)</option>
                                <option value="Cisco CCNP">Cisco CCNP (Certified Network Professional)</option>
                                <option value="Microsoft Azure Fundamentals">Microsoft Azure Fundamentals</option>
                                <option value="Microsoft Azure Administrator">Microsoft Azure Administrator</option>
                                <option value="AWS Certified Cloud Practitioner">AWS Certified Cloud Practitioner</option>
                                <option value="AWS Solutions Architect">AWS Solutions Architect</option>
                                <option value="Google Cloud Associate">Google Cloud Associate Engineer</option>
                                <option value="Oracle Certified Professional">Oracle Certified Professional</option>
                            </optgroup>

                            <optgroup label="Programming & Development">
                                <option value="Oracle Java Certification">Oracle Java Certification</option>
                                <option value="Microsoft Certified: Azure Developer">Microsoft Certified: Azure Developer</option>
                                <option value="Certified Kubernetes Administrator">Certified Kubernetes Administrator (CKA)</option>
                                <option value="Red Hat Certified Engineer">Red Hat Certified Engineer (RHCE)</option>
                                <option value="Salesforce Certified Developer">Salesforce Certified Developer</option>
                            </optgroup>

                            <optgroup label="Cybersecurity">
                                <option value="Certified Ethical Hacker">Certified Ethical Hacker (CEH)</option>
                                <option value="CISSP">CISSP (Certified Information Systems Security Professional)</option>
                                <option value="CISM">CISM (Certified Information Security Manager)</option>
                                <option value="ISO 27001 Lead Auditor">ISO 27001 Lead Auditor</option>
                            </optgroup>

                            <optgroup label="Data & Analytics">
                                <option value="Google Data Analytics">Google Data Analytics Professional Certificate</option>
                                <option value="Microsoft Power BI">Microsoft Certified: Power BI Data Analyst</option>
                                <option value="Tableau Desktop Specialist">Tableau Desktop Specialist</option>
                                <option value="Cloudera Data Engineer">Cloudera Certified Data Engineer</option>
                            </optgroup>

                            <optgroup label="Project Management">
                                <option value="PMP">PMP (Project Management Professional)</option>
                                <option value="CAPM">CAPM (Certified Associate in Project Management)</option>
                                <option value="Scrum Master">Certified Scrum Master (CSM)</option>
                                <option value="Agile Certified Practitioner">PMI Agile Certified Practitioner (PMI-ACP)</option>
                                <option value="PRINCE2">PRINCE2 Certification</option>
                            </optgroup>

                            <optgroup label="Design & Creative">
                                <option value="Adobe Certified Professional">Adobe Certified Professional</option>
                                <option value="Google UX Design">Google UX Design Professional Certificate</option>
                                <option value="HubSpot Content Marketing">HubSpot Content Marketing Certification</option>
                            </optgroup>

                            <optgroup label="Philippines-Specific">
                                <option value="DICT Digital Jobs PH">DICT Digital Jobs PH Certificate</option>
                                <option value="PhilNITS">PhilNITS (Philippine NITS Exam)</option>
                                <option value="PSITE Certification">PSITE IT Professional Certification</option>
                            </optgroup>

                            <option value="other">Other (Specify below)</option>
                        </select>

                        @error('type')
                            <p class="text-error text-sm mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Custom Certification Name (shown when "Other" is selected) -->
                    <div class="form-control space-y-3"
                        id="custom-cert-field"
                        style="display: none;">
                        <label class="label">
                            <span class="label-text font-semibold text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Certification Name
                            </span>
                            <span class="label-text-alt text-error">*Required</span>
                        </label>
                        <input type="text"
                            name="custom_certification"
                            id="custom-cert-input"
                            class="input input-bordered w-full input-lg focus:input-primary transition-all duration-200"
                            placeholder="Enter certification name">

                        @error('custom_certification')
                            <p class="text-error text-sm mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Description
                            </span>
                            <span class="label-text-alt text-base-content/60">Optional</span>
                        </label>
                        <textarea name="description"
                            class="textarea textarea-bordered w-full h-32 textarea-lg focus:textarea-primary transition-all duration-200"
                            placeholder="Add details or notes about your certification (e.g., specialization, completion date, key skills)"></textarea>

                        @error('description')
                            <p class="text-error text-sm mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Upload Document -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                Upload Certification Document
                            </span>
                            <span class="label-text-alt text-error">*Required</span>
                        </label>
                        <div class="relative">
                            <input type="file"
                                name="document"
                                class="file-input file-input-bordered file-input-primary w-full file-input-lg transition-all duration-200"
                                accept=".pdf,.jpg,.jpeg,.png"
                                required>
                        </div>
                        <div class="bg-info/10 border border-info/30 rounded-lg p-3">
                            <p class="text-xs text-info flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <span>Accepted formats: PDF, JPG, PNG (Max 5MB)</span>
                            </p>
                        </div>

                        @error('document')
                            <p class="text-error text-sm mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Live File Preview -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                Preview
                            </span>
                        </label>

                        <div id="file-preview"
                            class="border-2 border-dashed border-base-300 rounded-xl p-8 bg-base-200 text-center hidden transition-all duration-300">
                            <p class="text-base-content/70">No file selected.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="btn btn-primary btn-lg w-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Application
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Add Custom Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const certTypeSelect = document.getElementById('cert-type');
            const customCertField = document.getElementById('custom-cert-field');
            const customCertInput = document.getElementById('custom-cert-input');
            const fileInput = document.querySelector('input[name="document"]');
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
                    img.className = "max-h-64 mx-auto rounded-lg shadow-lg border-2 border-primary/20";
                    previewBox.appendChild(img);
                }

                // PDF preview (filename only for security)
                else if (fileType === "application/pdf") {
                    const wrapper = document.createElement('div');
                    wrapper.className = "flex items-center justify-center gap-3 p-4 bg-primary/10 rounded-lg border border-primary/30";

                    const icon = document.createElement('div');
                    icon.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    `;

                    const textWrapper = document.createElement('div');
                    textWrapper.className = "text-left";

                    const p = document.createElement('p');
                    p.textContent = file.name;
                    p.className = "font-semibold text-base-content";

                    const size = document.createElement('p');
                    size.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                    size.className = "text-sm text-base-content/60";

                    textWrapper.appendChild(p);
                    textWrapper.appendChild(size);
                    wrapper.appendChild(icon);
                    wrapper.appendChild(textWrapper);
                    previewBox.appendChild(wrapper);
                } else {
                    previewBox.innerHTML = `
                        <div class="flex items-center justify-center gap-2 text-error">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p>Unsupported file format</p>
                        </div>
                    `;
                }
            });
        });
    </script>
</x-layouts.app>
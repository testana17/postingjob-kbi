<footer class="bg-white py-12 border-t">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Category Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Category</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Graphic Design & Branding</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Web & Programming</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Videography, Photography & Audio</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Writing & Translation</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Marketing & Ads</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Consultation</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Lifestyle</a></li>
                </ul>
            </div>

            <!-- How to use Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4">How to use</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">How Clients Work</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">How Freelancers Work</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Freelancer Level</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Guarantee/Money Back Guarantee</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Freelancer Regulations</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Client Regulations</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Condition</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- About Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4">About Postingjob.com</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Postingjob Business</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Postingjob Solution</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Portfolio</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Blogs</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">About Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Copyright</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Partners</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Press Room</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">FAQ / Help</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Media Kit</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact us</h3>
                <div class="bg-[#1a237e] text-white rounded-lg p-4 mb-6">
                    <h4 class="font-semibold mb-2">Contact us</h4>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span>0821-2121-4811</span>
                    </div>
                    <div class="flex items-center space-x-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span>ask@Postingjob.com</span>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600">Ruko ITC Permata Hijau, Blok Diamond 3, Jl. Arteri Permata Hijau No.11, Kebayoran Lama, Jakarta Selatan, 12210.</p>
                </div>

            </div>
        </div>

        <!-- Security & Payment -->
        <div class="mt-12">
            <h3 class="text-lg font-semibold mb-4">Security & Payment</h3>
            <div class="flex flex-wrap gap-4 text-2xl">
                @foreach([
                    'fa-solid fa-shield-halved', // PSE (Security)
                    'fa-brands fa-cc-visa', // Visa
                    'fa-brands fa-cc-mastercard', // Mastercard
                    'fa-solid fa-landmark', // BCA (Bank)
                   
                    'fa-solid fa-money-check-alt' // Permata (Bank)
                ] as $icon)
                    <i class="{{ $icon }} text-[#1a237e]"></i>
                @endforeach
            </div>
        </div>
        
    </div>
</footer>
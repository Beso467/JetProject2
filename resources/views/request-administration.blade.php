<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request Administration
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-700 mb-3">Request Administration</h3>
                <p>If you'd like to request administration privileges, please send an email to <a href="mailto:beso467@gmail.com">beso467@gmail.com</a> with your request details.</p>

                <br/>
                <button onclick="sendEmail()" class="btn btn-primary">Send Email</button>
            
                <script>
                    function sendEmail() {
                        window.location.href = "mailto:beso467@gmail.com?subject=Administration%20Request&body=Dear%20Administrator,%0D%0A%0D%0AI%20would%20like%20to%20request%20administration%20privileges.%0D%0A%0D%0AThank%20you.";
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Changelog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Add your changelog content here -->
                <h3 class="font-medium text-gray-700 mb-3">Changelog</h3>
                <ul class="list-disc pl-5">
                    <li>Version 1.0 - Initial Release</li>
                    <br/>
                    <li>Version 1.0.1 - Added new features:
                        <br/>
                        -added new authentications and admin accounts<br/>
                        -added new requirements for creating projects <br/>
                        -added pagination and searchbar for the dashboard <br/>
                        -fixed issues with old accounts<br/>
                        -removed teams tab<br/>
                        -added update status feature Note:currently the completed status is not working as intended this will be added in a later update
                        <br/>
                        <br/>
                        KNOWN ISSUES: <br/>-Searching for specific clients does not work (this will be fixed in a later update)


                    </li>
                    <br/>
                    <li>Version 1.0.2 - Added new features:
                        <br/>
                        -Project logo and Client profile picture added -admin
                        <br/>
                        -Added Expected end time for projects -user and admin
                        <br/>
                        -Reduced contract date font -user and admin
                        <br/>
                        -Design polishing and enhancement -user and admin
                    </li>
                    <br/>
                    <li>Version 1.1 - Added new features:
                        <br/>
                        -Upgraded performance -viewer and admin<br/>
                        -Now when adding a project the employee salaries are visible -admin<br/>
                        -Fixed an issue with the dashboard edit status not working properly when selecting completed -admin<br/>
                        -Salaries now half when part time is selected<br/>
                        -Added completion date when the status is completed that replaces the edit status button to avoid confusion -admin<br/>
                        -Added Employees to the dashboard table that views all the Employees that are working/worked on the project
                        <br/> -Added warning when contract price is lower than selected employees salaries
                        <br/>
                        <br/>
                        KNOWN ISSUES: <br/>
                        -Salaries dont update when changing working hours for adding a new project / for now added a note above the employee checkbox -admin
                    </li>
                    <br/>
                    
                    <li>Version 1.1.1 (current) - Added new features:
                        <br/>
                        -added new administration request for users

                    </li>
                    <!-- Add more changelog items as needed -->
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

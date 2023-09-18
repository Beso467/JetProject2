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
                <div class="changelog-container">
                    <ul class="list-disc pl-5">
                        <li> <strong>Version 1.2.1b (current) - Added new adjustments:</strong>
                            <ul class="list-disc pl-5">
                                <li>More PDF testing added project logos</li>
                                <li>Code cleanups</li>
                                <li>Added BETA on the PDF link for clarity</li>
                            </ul>
                            <br/>
                            <strong>KNOWN ISSUES:</strong>
                            <ul class="list-disc pl-5">
                                <li>PDF view is not the same as the normal dashboard to save loadtime this is intentional</li>
                                <li>The Employee list doesn't show part-time salaries, added a note as a temporary fix</li>
                                <li>Minor visual glitches on the navigation bar</li>
                                <li>The loadtime required for PDF download link is slow</li>
                            </ul>
                            <br>
                        <li> <strong>Version 1.2.1a (current) - Added new features:</strong>
                            <ul class="list-disc pl-5">
                                <li>Added "Download pdf" option for dashboard will add them for other pages "soon TM"</li>
                            </ul>
                            <br/>
                            <strong>KNOWN ISSUES:</strong>
                            <ul class="list-disc pl-5">
                                <li>PDF view is not the same as the normal dashboard to save loadtime this is intentional</li>
                                <li>The Employee list doesn't show part-time salaries, added a note as a temporary fix</li>
                                <li>Minor visual glitches on the navigation bar this will be fixed in a later hotfix</li>
                            </ul>
                            <br>
                        <li>Version 1.2.0 - Added new features:
                            <ul class="list-disc pl-5">
                                <li>Upgraded and cleaned up the navigation bar.</li>
                                <li>Cleaned up code and bug fixes.</li>
                                <li>Added NEW Client list and Employee list with their own search bar and pagination</li>
                                <li>Changelog Upgrades for ease of use</li>
                            </ul>
                            <br>
                            <strong>KNOWN ISSUES:</strong>
                            <ul class="list-disc pl-5">
                                <li>The Employee list doesn't show part-time salaries, added a note as a temporary fix</li>
                                <li>Minor visual glitches on the navigation bar this will be fixed in a later hotfix</li>
                            </ul>
                        </li>
                        
                        </li>
                        <br>
                        <li>Version 1.1.2 - Added new features:
                            <br>
                            -Admin and User QOL changes: responsive improvements for small screens - new colors for completed date where <span style="color: red">RED</span> = late and <span style="color:lightgreen">GREEN</span> = ontime/early<br>
                              
                            -NEW publish/unpublish button feature for admins for more control over the projects<br/>
                            -Performance upgrades<br/>
                            -dashboard improvements and simplification<br/>
                            <br>
                            KNOWN ISSUES:<br>
                            on super small screens the full top menu does not appear this will be hotfixed soon - this has been hotfixed in patch 1.1.2a (current)
                        </li>
                        <br>
                        <!-- Add more changelog items here -->
                        <li>Version 1.1.1 - Added new features:
                            <br/>
                            -added new administration request for users
    
                            --hotfix (1.1.1a)
                            fixed login issues
    
                            ---hotfix (1.1.1b)
                            fixed search issues (finally)
                        </li>
                        <br>
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
                        <br>
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
                        <br>
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
                        <br>
                        <li>Version 1.0 - Initial Release</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .changelog-container {
        max-height: 400px; /* Adjust the height as needed */
        overflow-y: auto; /* Add a scrollbar when content exceeds the height */
        padding-right: 20px; /* Add space for scrollbar to prevent content from shifting */
    }
</style>

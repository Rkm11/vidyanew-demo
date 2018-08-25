<div class="page-sidebar fixedscroll">

    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper" style="background-color:#5aca9b;">

        <!-- USER INFO - START -->
        <div class="profile-info row">

            <div class="profile-image col-xs-7">
                <a href="ui-profile.html">
                    <img alt="" src="{{ asset('public/data/profile/logo.png') }}" class="img-responsive img-circle">
                </a>
            </div>

            <div class="profile-details col-xs-8">

                <h3>
                    {{-- <a href="ui-profile.html" style="color:#ffffff;">VBC Admin</a> --}}

                    <!-- Available statuses: online, idle, busy, away and offline -->
                    <span class="profile-status online"></span>
                </h3>

                {{-- <p class="profile-title" style="color:#ffffff;">Receptionist</p> --}}

            </div>

        </div>
        <!-- USER INFO - END -->



        <ul class='wraplist'>

            <li class='menusection' style="color:#ffffff;">Main</li>
           <li class="open">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard" style="color:#ffffff;"></i>
                    <span class="title" style="color:#ffffff;">Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-columns" style="color:#ffffff;"></i>
                    <span class="title"style="color:#ffffff;">Add</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" style="background-color: #424a5d;" >
                    <li>
                        <a href="{{ route('enquiry.create') }}" style="color:#ffffff;">Enquiry Form</a>
                    </li>
                    <li>
                        <a href="{{ route('admission.create') }}" style="color:#ffffff;">Admission Form</a>
                    </li>
                    <li>
                        <a href="{{ route('attendance.create') }}" style="color:#ffffff;">Attendance</a>
                    </li>
                    <li>
                        <a href="{{ route('marksheet.create') }}" style="color:#ffffff;">Marksheet</a>
                    </li>
                    <li>
                        <a href="{{ route('test.create') }}" style="color:#ffffff;">Test</a>
                    </li>
                <!--    <li>
                        <a href="{{ route('parent.index') }}" style="color:#ffffff;">Parent Registration</a>
                    </li>  -->
                    <li>
                        <a href="{{ route('invoice.index') }}" style="color:#ffffff;">Invoice</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('invoice.create') }}" style="color:#ffffff;">Add Invoice</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('payment.create') }}" style="color:#ffffff;">Payment Vouchers</a>
                    </li>
                    <li>
                        <a href="{{ route('others') }}" style="color:#ffffff;">Others</a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('others') }}" style="color:#ffffff;">Addendane Upload</a>
                    </li> -->
                  <!--  <li>
                        <a href="#" style="color:#ffffff;">Teacher Registration</a>
                    </li> -->

                    <li>
                        <a href="{{ route('telecalling.index') }}" style="color:#ffffff;">Tele-Calling</a>
                    </li>



                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-columns" style="color:#ffffff;"></i>
                    <span class="title" style="color:#ffffff;">View</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" style="background-color: #424a5d;" >
                    <li>
                        <a href="{{ route('enquiry.index') }}" style="color:#ffffff;">Enquiries</a>
                    </li>
                    <li>
                        <a href="{{ route('admission.index') }}" style="color:#ffffff;">Admissions</a>
                    </li>
                    <li>
                        <a href="{{ route('attendance.index') }}" style="color:#ffffff;">Attendance</a>
                    </li>
                    <li>
                        <a href="{{ route('marksheet.all') }}" style="color:#ffffff;">Marksheet</a>
                    </li>
                    <li>
                        <a href="{{ route('marksheet.index') }}" style="color:#ffffff;">All Student Marksheet</a>
                    </li>
                    <li>
                        <a href="{{ route('balance-sheet.index') }}" style="color:#ffffff;">Balance Sheet</a>
                    </li>



                    {{-- <li>
                        <a href="#">View All Users</a>
                    </li> --}}
                    {{--
                    <li>
                        <a href="invoice.php" style="color:#ffffff;">Invoice</a>
                    </li> --}}
                    {{-- <li>
                        <a href="payment_voucher.php" style="color:#ffffff;">Payment Voucher</a>
                    </li> --}}
                </ul>
            </li>
            {{-- <li>
                <a href="javascript:;">
                    <i class="fa fa-columns"></i>
                    <span class="title" style="color:#ffffff;">Others</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" style="background-color: #424a5d;">
                    <li>
                        <a href="{{ route('standard.create') }}" style="color:#ffffff;">Standard</a>
                    </li>
                    <li>
                        <a href="{{ route('medium.create') }}">Medium</a>
                    </li>
                    <li>
                        <a href="{{ route('batch.create') }}" style="color:#ffffff;">Batch</a>
                    </li>
                    <li>
                        <a href="{{ route('subject.create') }}">Subject</a>
                    </li>
                    <li>
                        <a href="{{ route('school.create') }}" style="color:#ffffff;">School</a>
                    </li>
                </ul>
            </li> --}}
            {{--<li> --}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-columns"></i>--}}
                    {{--<span class="title" style="color:#ffffff;">User Approval</span>--}}
                    {{--<span class="arrow "></span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu" >--}}
                    {{--<li>--}}
                        {{--<a href="view_user.php" style="color:#ffffff;">View All Users</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

          <!--  <li>
                <a href="sms_sending.php">
                    <i class="fa fa-table" style="color:#ffffff;"></i>
                    <span class="title" style="color:#ffffff;">Sms Body</span>
                </a>
            </li> -->
        </div>
        <!-- MAIN MENU - END -->
    </div>
<!--  SIDEBAR - END
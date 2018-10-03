<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
 <!-- CORE JS FRAMEWORK - START -->

<!-- START SCRIPT AREA------------------------------------------------------------------------- -->
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<script src="{{ asset('public/assets/js/classie.js')}}"></script>
        <script src="{{ asset('public/assets/js/gnmenu.js')}}"></script>
        <script>
            new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>

@stack('footer')
</body>
</html>

        </div>
        <script>
        <!--//--><![CDATA[//><!--
            if ( !checkCookie(skin) ) { setCookie(skin, 'color-elegant', 365); }
            var o = getCookie(skin).replace('color','');
            document.querySelector('body > .container-fluid').className = 'container-fluid color' + o;
            if ( o == '-dark-mood' ) {
                document.querySelector('body').className = 'color' + o;
            }
            document.querySelectorAll('.themes .btn').forEach(function(v,i){
                if ( v.className.search(o) !== -1 ) {
                    var cn = document.querySelector('.themes .btn'+o).className;
                    document.querySelector('.themes .btn'+o).className = cn + ' set';
                }
            });
            var fs = getCookie('fullscreen');
            if ( fs ) { 
            }
        //--><!]]>
        </script>
        <script src="media/js/popper.min.js"></script>
        <script src="media/js/bootstrap.js"></script>
        <script src="media/js/mdb.js"></script>
        <script src="media/js/<?= md5('jquery.dataTables.min.js') ?>"></script>
        <script src="media/js/<?= md5('dataTables.bootstrap4.min.js') ?>"></script>
        <script src="media/js/<?= md5('snarl.js') ?>"></script>
        <script src="media/js/simple-scrollbar.js"></script>
        <script src="media/js/jquery.multi-select.js"></script>
        <script src="media/js/countUp.js"></script>
        <script src="media/js/countup-jquery.js"></script>
        <script src="media/js/e03c806f727374e1b4b6a138e6efa804"></script>
        <script src="media/js/<?= md5('mylite.init.native.js') ?>"></script>
        <script src="media/js/<?= md5('mylite.init.jquery.js') ?>"></script>
        <script src="media/js/<?= /*md5*/('javascript.js') ?>"></script>
        <script src="media/js/<?= md5('global.datatables.js') ?>"></script>
        <script src="media/js/<?= md5('custom.datatables.js') ?>"></script>
    </body>
</html>

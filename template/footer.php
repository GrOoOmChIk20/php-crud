        </div>
        </body>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        <script>
            todayDate = new Date();
            todayYear = todayDate.getFullYear();
            todayDay = todayDate.getDate();
            todayMonth = todayDate.getMonth() + 1;

            minDate = formatDate(new Date(todayYear - 130, todayMonth - 1, todayDay));
            maxDate = formatDate(new Date(todayYear - 14, todayMonth - 1, todayDay));

            document.getElementById("form-control-datepicker").onclick = function() {
                var input = document.getElementById("form-control-datepicker");
                input.setAttribute("max", maxDate);
                input.setAttribute("min", minDate);
            }

            function formatDate(date) {

                var dd = date.getDate();
                if (dd < 10) dd = '0' + dd;

                var mm = date.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;

                var yy = date.getFullYear();

                return yy + '-' + dd + '-' + mm;

            }
        </script>

        </html>

        <?php 
        
        unset($_SESSION['errorField']); 
        unset($_SESSION['succesField']); 
        
        
        ?>
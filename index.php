<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col">
                <form id="devs_form">
                    <input type="text" name="name" placeholder="Name">
                    <input type="text" name="age" placeholder="Age">
                    <input type="text" name="skill" placeholder="Skill">
                    <input type="text" name="location" placeholder="Location">
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <table class="table table-stripped table-borderd">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Skill</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="devs_data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            // get all devs data 
            const getAllDevsData = () => {
                $.ajax({
                    url: "./ajax/getAllDevs.php",
                    success: (data) => {
                        $("#devs_data").html(data);
                    }
                });
            }

            getAllDevsData();

            $('#devs_form').submit(function(e) {
                e.preventDefault();

                const form_data = new FormData(e.target);
                const {
                    name,
                    age,
                    skill,
                    location
                } = Object.fromEntries(form_data);

                $.ajax({
                    url: "./ajax/createDevs.php",
                    method: "POST",
                    data: {
                        name,
                        age,
                        skill,
                        location
                    },
                    success: (data) => {

                        e.target.reset();
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        getAllDevsData();
                    },
                    error: (error) => {
                        console.log(error);

                    }
                });




            })

            $(document).on('click', ".delete-devs", function() {
                const deleteId = $(this).attr('delete-id');


                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: `./ajax/deleteDevs.php?deleteId=${deleteId}`,
                            success: (data) => {
                                getAllDevsData();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            }
                        });



                    }
                });

            });
        });
    </script>

</body>

</html>
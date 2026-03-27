<?php
include '../config/db.php';
include_once '../includes/upload_helpers.php';
include_once '../includes/admin_auth.php';
include_once '../includes/admin_data_helpers.php';
admin_require_auth(true);

// Method POST It works now

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_notice'])) {
        $classId = $_POST["class_id"];
        $IDImage = 'file-upload-modified'. $classId;
        $fileUploadName = $_FILES[$IDImage]['name'] ?? '';
        $fileUploadTmp = $_FILES[$IDImage]['tmp_name'] ?? '';
        

        $sqlfileurl = "";
        $storedPath = store_uploaded_file($fileUploadName, $fileUploadTmp, '../assets/images/routines', 'assets/images/routines', 'routine');
        if ($fileUploadName !== '' && $storedPath === null && has_upload_error()) {
            echo '<script>alert(' . json_encode(get_upload_error_message()) . ');</script>';
            exit;
        } elseif ($storedPath !== null) {
            $sqlfileurl = $storedPath;
        }

        $updated_at = date("Y-m-d H:i:s");

        // Insert data into the school_notice table
        $sql = "UPDATE schoolroutine SET routine_url=?, updated_at=? WHERE id=?";

        if (db_execute($connection, $sql, [$sqlfileurl, $updated_at, $classId])) {
            echo '
            <script>
            alert("Routine has been updated sucessfully")
            window.location.replace("change_routine.php");
              
            </script>';
        } else {
            echo "Error: Failed to update routine.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Routine | Pashupati</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../assets/images/admin_logo.png">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>


</head>

<body>
    <?php include('../includes/admin_header.php') ?>

    <main>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 pb-0 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-blue-600">Change Class Routine</h1>
                <p class="text-sm md:text-base lg:w-2/3 mx-auto leading-relaxed text-base"> 🏫 Here, you have the ability to adjust the class routine according to our dynamic schedule. 💼 Feel free to make necessary changes to ensure that our students receive the best possible education. 📅 
                </p>
            </div>
        </div>   
    </section>
        <!-- Start block -->
        <section class="bg-gray-50 dark:bg-gray-900 p-3 mt-0 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-xl px-0 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Class</th>
                              
                                    <th scope="col" class="px-4 py-3">Last Updated</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $class = get_routine_rows($connection);
                                $totalNotice = count($class);

                                if ($totalNotice > 0) {
                                    foreach ($class as $row) {
                                        $classId = $row['id'];
                                        echo '
                                            <tr class="border-b dark:border-gray-700">
                                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white  max-w-[10rem] truncate">' . $row['class_name'] . '</th>
                                                

                                                <td class="px-4 py-3">' . $row['display_updated_at'] . '</td>
                                                <td class="px-4 py-3 flex items-center justify-end">
                                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown' . $row['id'] . '" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </button>
                                                    <div id="apple-imac-27-dropdown' . $classId . '" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-1 text-sm" aria-labelledby="apple-imac-27-dropdown-button">
                                                            <li>
                                                                <button type="button" data-modal-target="updateProductModal' . $classId . '" data-modal-toggle="updateProductModal' . $classId . '" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                                    </svg>
                                                                    Edit
                                                                </button>
                                                            </li>

                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                
                                            ';
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">

                    </nav>
                </div>
            </div>
        </section>

        <!-- Update modal -->
        <?php
        $class = get_routine_rows($connection);
        $totalNotice = count($class);

        if ($totalNotice > 0) {
            foreach ($class as $row) {
                $classId = $row['id'];
                echo '

                        <div id="updateProductModal' . $classId . '" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                
                                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Routine</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal' . $classId . '">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form method="post" id="UpdateNotice' . $classId . '" enctype="multipart/form-data">
                                        ' . admin_csrf_input() . '
                                        <div class="grid gap-4 mb-4 sm:grid-cols-1">
                                        <div><label for="new_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">If you didnot choose any pic routine will be removed from website or simply select none to remove routine.</label></div><br>
                                            <div class="flex items-center justify-center w-full">
       
                                                <input name="file-upload-modified'.$classId.'" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                                <input class="hidden" name="class_id" value="' . $classId . '" type="text">
                                            </div>

                                            
                                            
                                        </div>
                                        
                                        <div class="flex items-center space-x-4">
                                            <button name="update_notice" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Routine</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ';
            }
        }
        ?>


    </main>

    <?php include('../includes/admin_footer.php') ?>

    <script>
        function displayFileName() {
            var fileInput = document.getElementById('file-upload');
            var fileInfoContainer = document.getElementById('file-info');


            if (fileInput.files.length > 0) {
                fileInfoContainer.innerHTML = '         File: ' + fileInput.files[0].name;
                fileInfoContainer.classList.remove('hidden');

            }
        }

        function displayFileNameShow() {
            var fileInput = document.getElementById('dropzone-file');
            var fileInfoContainer = document.getElementById('file-info-modified');

            if (fileInput.files.length > 0) {
                fileInfoContainer.innerHTML = 'File: ' + fileInput.files[0].name;
                fileInfoContainer.classList.remove('hidden');
            }
        }

        console.clear();
    </script>



</body>


</html>

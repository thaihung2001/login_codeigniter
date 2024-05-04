<h1>Welcome <u><?php echo $this->session->userdata('UserLoginSession')['username']; ?></u> to DashBoard</h1>
<h1 style="color:red;"><?php if($this->session->userdata('UserLoginSession')['author']!=0){echo "User not authorization!"; die();} ?></h1>
<div class="container">
    <!-- <form action="<? //base_url('upload')
                        ?>" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" multiple="" class="custom-file-input" id="uploadfile" name="uploadfile[]" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="btn_upload" id="btn_upload">Upload</button>
                    <?php //if($this->session->flashdata('message')) {
                    ?>
                        <span class="text-primary"><?php //echo  $this->session->flashdata('message');
                                                    ?></span>
                    <?php //} 
                    ?>
                </div>
                </div>
            </form> -->
    <div class="container mt-5">
        <h2> Action User Permissions</h2>
        <form id="userPermission">
            <select id="userSelect" name="user" class="custom-select col-4">
                <option selected> Select User</option>
            </select>
            <select id="permissionSelect" name="permission" class="custom-select col-2">
                <option selected> Select Permission</option>
            </select>
            <select id="actionSelect" name="action" class="custom-select col-2">
                <option value="" selected> Choose Action</option>
                <option value="Grant">Grant</option>
                <option value="Revoke">Revoke</option>
            </select>
            <button type="submit" class="btn btn-primary">Go</button>
        </form>
    </div>
    <div class="container mt-5">
        <h2> Load User Permissions (Using PHP)</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($datas) != FALSE) {
                    // sort array datas
                    usort($datas, function ($a, $b) {
                        return $a['userID'] <=> $b['userID'];
                    });

                    //var_dump($datas);
                    $i = 1;
                    foreach ($datas as $data) {
                        $id_user = $data["userID"];
                        $id_per = $data["permissionID"];
                        $username = $data["username"];
                        $email = $data["email"];
                        $view = $data["PermissionName"] === "View" ? "checked" : "disabled";
                        $edit = $data["PermissionName"] === "Edit" ? "checked" : "disabled";
                        $delete = $data["PermissionName"] === "Delete" ? "checked" : "disabled";
                ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $username ?></td>
                            <td><?= $email ?></td>
                            <td><input type="checkbox" class="form-check-input" <?= $view ?>></td>
                            <td><input type="checkbox" class="form-check-input" <?= $edit ?>></td>
                            <td><input type="checkbox" class="form-check-input" <?= $delete ?>></td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
            //get data
            $.ajax({
                url: "<?php echo site_url('loadData'); ?>",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let users = response.users; //data user
                    let permissions = response.permissions; //data permission
                    //console.log('users',users);
                    //console.log('permissions',permissions);

                    // fill data in user select
                    let userselect = $('#userSelect');
                    userselect.empty();
                    userselect.append($('<option>').text('Select User').attr('selected', 'selected').attr('value', ''));

                    $.each(users, function(index, value) {
                        userselect.append($('<option>').text(value.username + " (" + value.email + ") ").attr('value', value.userID));
                    });

                    //fill data in permission select
                    let permissionselect = $('#permissionSelect');
                    permissionselect.empty();
                    permissionselect.append($('<option>').text('Select Permission').attr('selected', 'selected').attr('value', ''));

                    $.each(permissions, function(index, value) {
                        permissionselect.append($('<option>').text(value.permissionName).attr('value', value.permissionID));
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


            //process data submit form
            $('#userPermission').submit(function(e) {
                e.preventDefault(); 
                // get input form
                var user = $('#userSelect').val();
                var permission = $('#permissionSelect').val();
                var action = $('#actionSelect').val();

                // check empty
                if (user && permission && action) {
                    // tạo formdata
                    var formData = {
                        user: user,
                        permission: permission,
                        action: action
                    };
                    //console.log(formData);return;
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url('processPermission'); ?>",
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            alert(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    // Hiển thị thông báo lỗi nếu có trường nào đó rỗng
                    alert('Please keep full 3 fiels!');
                }
            });
        });
    </script>
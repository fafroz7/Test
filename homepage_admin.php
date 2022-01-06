<?php
    session_start();
    if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])){
        ?>
            <title>Home Page</title>
            <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
            <div class="navbar border b-2 border b-gray-500">
                <img src="logo.PNG" class="m-1 p-1 h-32">
                <div class="p-4 flex bg-gray-400 justify-between">
                <a class="text-xl font-medium hover:text-gray-600" href="homepage_admin.php"> Home </a>
                <a class="hidden md:flex text-xl font-medium hover:text-gray-600" href="addvet.php"> Add Vet Info</a>
                <a class="hidden md:flex text-xl font-medium hover:text-gray-600" href="paymentinfo.php"> Payment list </a>
                <a class="hidden md:flex text-xl font-medium hover:text-gray-600" href="#contact"> Pet food </a>
                <a class="hidden md:flex text-xl font-medium hover:text-gray-600" href="#contact"> Emargency Support </a>
                <a class="hidden md:flex text-xl font-medium hover:text-gray-600" href="#contact"> Review </a>
                <div>
                    <input class="px-8 py-1.5 bg-white border rounded border-gray-600" type="search" id="searchbox" placeholder="Tap to search" autocomplete="off">
                    <input class="px-2 py-1 text-lg text-white border rounded border-gray-800 bg-green-700 hover:bg-green-800" type="button" value="Search" id="searchbtn">
                </div>
                <input class="px-2 text-lg text-white border rounded border-gray-800 bg-red-700 hover:bg-red-800" type="button" value="Log out" id="logoutbtn">
                </div>
            </div><br>
            <script>
                var srcbtn=document.getElementById('searchbtn');
                srcbtn.addEventListener('click', searchprocess);
                
                function searchprocess(){
                    var searchvalue=document.getElementById('searchbox').value;
                    window.location.assign("searchpage_admin.php?param1="+searchvalue);
                }
                
            </script>
                    <?php
                        try{
                            $dbcon = new PDO("mysql:host=localhost:3306;dbname=petlover;","root","");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $sqlquery="SELECT * FROM adoption_post as a JOIN user as u ON a.username = u.username Order By post_id DESC";
                            
                            try{
                                $returnval=$dbcon->query($sqlquery);                               
                                $productstable=$returnval->fetchAll();
                                foreach($productstable as $row){
                                    ?><br>
                                    <div class="max-w-xl mx-auto bg-gray-300">
                                       <table>
                                             <thead>
                                                    <tr>  
                                                        <th>
                                                            <div class="px-6 py-10">
                                                            <h4 class="text-lg">PostId: <?php echo $row['post_id'] ?></h4>
                                                            <h4 class="text-lg">Username: <?php echo $row['username'] ?></h4> 
                                                            <h4 class="text-lg">Location: <?php echo $row['location'] ?></h4>
                                                            <h4 class="text-lg">Description: <?php echo $row['description'] ?></h4>
                                                            <h4 class="text-lg">Price: <?php echo $row['price']?> TK</h4>
                                                            <h4 class="text-lg">Phone Number: <?php echo $row['phone']?></h4>
                                                            <h4 class="text-lg">Email: <?php echo $row['email']?></h4>
                                                        </th><br>              
                                                            <td><img class= "h-60 w-56 border rounded border-gray-800" alt="Pet Photo" src="<?php echo $row['imagepath'] ?>"></td></div>
                                                    </tr>
                                                <th>
                                            <a class="p-4 px-6 py-1 font-normal text-lg text-white border rounded border-gray-800 bg-red-600 hover:bg-red-700" href="deletepost_admin.php?post=<?php echo $row['post_id']?>">Delete</a></th>
                                    <?php
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                       <tr> <th colspan="5">Data read error ... ...</th></tr>    
                                <?php
                            }
                            
                        }
                        catch(PDOException $ex){
                            ?>
                                    <tr><th colspan="5">Data read error ... ...</th></tr>
                            <?php
                        }
                    ?> 
                    </thead>
                </table>
            </div><br>
            <script>
                var elm=document.getElementById('logoutbtn');
                elm.addEventListener('click', processlogout);
                
                function processlogout(){
                    window.location.assign('logout.php');
                }
                
            </script>

        <?php
    }
    else{
        ?>
            <script>
                window.location.assign('index.html');
            </script>
        <?php
    }
?>
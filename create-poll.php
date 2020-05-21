<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./profile.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to Profile</span>
            		</a>
          </div>
    </div>
</section>

<section class="section section_main">
    <div class="row">
        <div class="col-auto">
            <div class="section_main__image" style="width: 7rem;height: 7rem;">
                <img src="https://robohash.org/<?php echo $addr; ?>" alt="pic" width="80"/>
            </div>
        </div>
            <div class="col">
                <div class="section_main__group">
                    <h1 class="section_main__title">
                        <?php echo $addr; ?>
                        <span class="badge badge-secondary" id="nick_name">Loading...</span>
                    </h1>
                    </div>
                    <a class="btn btn-small btn-primary" href="https://scan.idena.io/address/<?php echo $addr; ?>" target="_blank">
                        <i class="icon icon--coins"></i><span>Address details on explorer</span>
                    </a>
                </div>
            </div>
</section>


<section class="section section_info">

    <div class="row">
        
          
          
          <div class="col-12 col-sm-3">
            <div class="card">
              <div>
                <div class="row">
                    
                    <div class="col-12 col-sm-12 bordered-col">
                        <h4 class="info_block__accent">Status</h4>
                        <p><?php echo $state; ?></p>
                        <br/>
                        <h4 class="info_block__accent">Age</h4>
                        <p><?php echo $age; ?></p>
                    </div>
                  

                </div>
              </div>
            </div>
          </div>
          
          
          
          <div class="col-12 col-sm-9">
            <div class="card">
              <div>
                <div class="row">
                  
                  <div class="col-12 col-sm-12 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>
                        
                        <h4 class="info_block__accent">Start a new poll</h4>
                        <form id="poll_form" METHOD="POST">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="desc" id="desc" class="formVal form-control" value="" placeholder="Will DNA beat btc?"/>
                                <input type="hidden" name="type" class="formVal" value="poll"/>
                            </div>
                            
                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="createPoll(); return false;" style="margin-top: 1em;">
                                <span id="text_submit">Create Poll</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>
                      
                        </form>
                        
                  </div>

                </div>
              </div>
            </div>
          </div>
        
    </div><!-- row end -->
    
</section>

<?php 
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->     
 </div>
</main>

<script type="text/javascript">
function createPoll()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData(); 
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
    
    ajax_post('./services/addpoll.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Poll created successfully';
            checkusername();
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }
    });
}

function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Creating...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Create Poll";
            document.getElementById("submit").classList.remove("disabled");   
    }
}
function checkusername() {
    ajax_get('./services/checkusername.php', function(data) {
            document.getElementById("nick_name").innerHTML = data["nickname"];
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.add("rem");
    });
}
window.onload = function() {
checkusername();
}
</script>
<?php 
include(dirname(__FILE__)."/partials/footer.php");
?>
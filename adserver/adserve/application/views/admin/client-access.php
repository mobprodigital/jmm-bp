<div class="content-wrapper">

    <section class="content-header">
        <label><input name="clients" id="clients" class="search form-control" style="width:295px;" placeholder="Search"
                value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
        <input type="submit" class="btn btn-primary" name="submit" id="submit" value="search">
        <div class="dropdown-content">
        </div>
        <small class="btn btn-large btn-primary"
            style=" float:right;"><?php echo anchor('admin/users/advertisement','Add new advertiser');?></small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <img
                            src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png" /><span>Advertiser</span>
                    </div>
                    <div class="box-body">
                        <?php $this->load->view('admin_includes/advertiser_header');?>
                        <a class="btn btn-primary" 
                            href="<?php echo base_url();?>users/advetiseruserstart?id=<?php echo $_GET['id'];?>">Add
                            User</a>

                        <div>
                            <?php if(isset($advtUserAssocData) &&!empty(($advtUserAssocData)) ){ ?>
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="header-row">
                                        <th width="25%">Email</th>
                                        <th width="15%">First Name</th>
                                        <th width="15%">Last Name</th>
                                        <th width="15%">Date Link</th>
                                        <th width="30%" class="center-align">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($advtUserAssocData as $key => $value){ ?>
                                    <tr
                                        style="background-color:<?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
                                        <td><img
                                                src="<?php echo base_url();?>/assets/upimages/icon-advertiser.png">&nbsp;&nbsp;
                                            <a
                                                href="<?php echo base_url();?>users/advetiseruserstart?userid=<?php echo $value->userid;?>&id=<?php echo $_GET['id'];?>"><?php echo $value->username;?></a>
                                        </td>
                                        <td><?php echo $value->firstname;?></td>
                                        <td><?php echo $value->lastname;?></td>
                                        <td><?php echo $value->date_created;?></td>
                                        <td class="last" style="text-align: center;padding-right:25px;"><a
                                                href="<?php echo base_url();?>users/advetiseruserstart?id=<?php echo $value->userid;?>"
                                                class="fa fa-edit"></a><a href="#" style="padding-left: 10px;"
                                                id="31"><small id="4" class="fa fa-trash-o"
                                                    style="color:red;padding-left:10px;"></small></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                            <div class="errormessage" ><img class="errormessage"
                                    src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16"
                                    border="0">There are currently no user available for this
                                advertiser</div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<?php $this->load->view('admin_includes/footer');?>
<div role="tabpanel" class="tab-pane active" id="{{ $tab_id }}" >

    <div class="panel panel-default">
        <div class="panel-heading">
            Contact Information
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" v-model="profile.name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" v-model="profile.email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"
                            v-submit="updatingProfile"
                            v-on:click.prevent="updateProfile"
                        >
                            <i class="fa fa-btn fa-save"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
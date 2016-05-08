<div role="tabpanel" class="tab-pane" id="{{ $tab_id }}">
    <div class="panel panel-default">
        <div class="panel-heading">Update Password</div>

        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-4 control-label">Current Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.current_password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">New Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.new_password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.new_password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"
                            v-submit="updatingPassword"
                            v-on:click.prevent="updatePassword"
                        >
                            <i class="fa fa-btn fa-save"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
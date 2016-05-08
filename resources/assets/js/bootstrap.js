var controllers = require('./vue/controllers');
var components = require('./vue/components');
var attachedControllers = {};
var notify = require('./misc/notify');

var mountControllers = (selector) => {
    console.log(selector);
    $(selector).each((i, el) => {
        var cName = $(el).attr('data-controller');
        console.log(cName);
        el.id = _.randomStr();
        if (controllers[cName] === undefined) console.warn(`Controller ${cName} is not found`);
        attachedControllers[cName] = new controllers[cName]({el: `#${el.id}`});
    });
};

var unmountControllers = (selector) => {
    $(selector).each((i, el) => {
        var cName = $(el).attr('data-controller');
        if (attachedControllers[cName] !== undefined) {
            attachedControllers[cName].$destroy(true);
        }
    });
};

export default {
    libraries() {
        if (typeof window.Bugsnag !== 'undefined') {
            Bugsnag.releaseStage = CObj.environment;
            Bugsnag.notifyReleaseStages = ["production", "staging"];
        }

        window.pusherSubscriptions = {};
        window.placeholder = require('placeholder');
        window._ = require('lodash');
        require('./extensions/lodash');
        window.moment = require('moment-business-days');
    },
    vue() {

        Vue.http.options.onComplete = (req) => {
            switch (req.status) {
                case 400:
                    notify.error(JSON.parse(req.response).error);
                    break;
                case 422:
                    notify.validation(JSON.parse(req.response));
                    break;
            }
        }

        require('./vue/directives');
        require('./vue/filters');

        mountControllers("[data-controller]");
    },
    pjax() {
        $(document).pjax('a[data-pjax]', '#pjax-container', {
            timeout: 3000
        });
        $(document).pjax('a[data-pjax-full]', '#pjax-big-container', {
            timeout: 3000
        });

        $(document).on('pjax:clicked', () => {
            notify.loading(true);
            if ($('#navbar').hasClass('in')) {
                $('#navbar').collapse('toggle');
            }
            if ($('#navbar-collapse-main').hasClass('in')) {
                $('#navbar-collapse-main').collapse('toggle');
            }
        });

        $(document).on('pjax:success', (e) => {
            mountControllers($(e.target).find("[data-controller]"));
            this.scripts();

            notify.loading(false);

            $('.modal-backdrop').remove();

            $(document).trigger('redraw.bs.charts');

            $("a[data-pjax]").each(function (i, el) {
                var $parent = $($(el).parent());

                if ($parent.is('li')) {
                    $(el).attr('href') == window.location.href ?
                        $parent.addClass('active') :
                        $parent.removeClass('active');
                }
            });
        });

        $(document).on('pjax:beforeReplace', (e) => {
            unmountControllers($(e.target).find("[data-controller]"));
        });
    },

    scripts() {
        $('.tooltipper').tooltip({
            html: true
        });
    }
}
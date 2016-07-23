# User access log

[![Codacy](https://img.shields.io/codacy/1ff45e2f65dc4986aabfb63eef43822f.svg)](https://www.codacy.com/app/vojtasvoboda/oc-useraccesslog-plugin)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/g/vojtasvoboda/oc-useraccesslog-plugin.svg)](https://scrutinizer-ci.com/g/vojtasvoboda/oc-useraccesslog-plugin/?branch=master)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/vojtasvoboda/oc-useraccesslog-plugin/blob/master/LICENSE.md)

Log access of users managed by RainLab.User plugin. Provide one dashboard widget for logged data visualisation. Tested with the latest stable OctoberCMS build 349.

Works well for example with [CodeLogin](http://octobercms.com/plugin/vojtasvoboda-codelogin) plugin for logging all user accesses and show it as a graph.

## Dependencies

Require RainLab.User plugin.

## Installation

1. Search VojtaSvoboda.UserAccessLog at System -> Updates -> Install plugins.
2. Place dashboard widget by clicking on dashboard button "Add widget".

## Future plans

- [x] another graph for visualise access in time (line graph)
- [ ] posibility to select which User attribute we want to display at the pie chart widget (name, username, email, ...)
- [ ] sent weekly/monthly reports to given email with nice graphs

**Feel free to send pullrequest!**

## Contributing

Please send Pull Request to master branch.

## License

Access log plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.
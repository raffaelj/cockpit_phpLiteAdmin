# phpLiteAdmin addon for Cockpit CMS

This addon adds a [phpLiteAdmin][1] interface for simple direct database access if you use Cockpit with SQLite.

I used the [latest version 1.9.7.1][5] and did some modifications. I know, I should have forked and built the whole thing, but it works for me. I made the initial commit without modifications, so you can see the differences in the [commit history][6].

**Caution: Never store this addon in your public available webroot `/addons`! If you do so, everyone has access to your database.**

## installation and usage

Copy this addon in a folder above your web root, e. g. `home/cockpit_data/addons/phpLiteAdmin`.

Add this to config.yaml:

```yaml
loadmodules:
    - "home/cockpit_data/addons"
```

Now phpLiteAdmin should be available in your admin interface if you have admin rights.

## config options

The addon works without any config, but you can adjust a few things:

```yaml
phpliteadmin:
    width: 100%
    height: 650px
    theme: Ugur3d
    rowsNum: 30
    charsNum: 300
    maxSavedQueries: 10
    cookie_name: pla3412
    debug: false
```

### available themes

* Sheep
* Ugur3d
* simpleGray
* Modern
* Default

If you want other themes, download them from the [official source][2] ([direct link to zip][3]) and copy them into `config/phpliteadmin/themes`.

### i18n

Download i18n files from the [official source][4] and copy them into `config/phpliteadmin/i18n`.

## License

phpLiteAdmin is licensed under the terms of the GNU General [Public License](http://www.gnu.org/licenses/gpl.html), so I chose the same license for this addon. See [LICENSE file](/LICENSE) for more information.


[1]: https://www.phpliteadmin.org/
[2]: https://www.phpliteadmin.org/download/
[3]: https://bitbucket.org/phpliteadmin/public/downloads/phpliteadmin_themes_2016-02-29.zip
[4]: https://bitbucket.org/phpliteadmin/public/wiki/Localization
[5]: https://bitbucket.org/phpliteadmin/public/downloads/phpLiteAdmin_v1-9-7-1.zip
[6]: https://github.com/raffaelj/cockpit_phpLiteAdmin/commit/4adfb8677ef46447defbcbdf914d0ffdea379b70

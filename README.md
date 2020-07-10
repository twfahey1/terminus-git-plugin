# Terminus Git Plugin

## Configuration

This plugin requires no configuration to use.

## Examples

`terminus git:clone mysite .` - Will clone the `mysite` Pantheon site down to the local drive.

## Installation
For help installing, see [Manage Plugins](https://pantheon.io/docs/terminus/plugins/)
```
mkdir -p ~/.terminus/plugins
composer create-project --no-dev -d ~/.terminus/plugins pantheon-systems/terminus-rsync-plugin:~1
```

## Help
Use `terminus help remote:rsync` to get help on this command.

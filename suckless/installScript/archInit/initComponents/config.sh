#!/bin/bash


sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
setxkbmap -option compose:prsc
pulseaudio-start

# TOUCHPAD  ###############################################################################
sudo cp ~/Desktop/Suckless/installScript/40-touchpad.conf /etc/X11/xorg.conf.d/
# BOOT TIME ###############################################################################
sudo cp ~/Desktop/Suckless/installScript/loader.conf /boot/loader/

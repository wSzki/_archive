#!/bin/sh

# TLP #####################################################################################
sudo pacman -S --noconfirm tlp #battery saver / powwer management || sudo tlp stat -s
sudo tlp start
sudo tlp true
sudo tlp stat -s
sudo systemctl start tlp.service
sudo systemctl start tlp.service
sudo systemctl enable tlp-sleep.service
sudo systemctl enable tlp-sleep.service
sudo systemctl mask systemd-rfkill.service
sudo systemctl mask systemd-rfkill.sokcet

sudo systemctl start fcron.service
sudo systemctl enable fcron.service

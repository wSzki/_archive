#!/bin/sh


# SUCKLESS ################################################################################

cd ~/Desktop && git clone https://github.com/wSzki/Suckless.git
cd ~/Desktop/Suckless

cd dwm && sudo make install
cd ../st && sudo make install
cd ../dwmblocks && sudo make install
cd ../dmenu && sudo make install
cd ../surf && sudo make install
cd ../slock && sudo make install

# CUSTOM SHELL COMMANDS ###################################################################
cd ~/Desktop/Suckless
cd ./bashApps && sudo cp ./* /bin

cd ~/Desktop/Suckless/rcfiles/
cp .* ~/

feh --bg-scale ~/.bg.png

cd /usr/share
git clone https://github.com/geometry-zsh/geometry.git 

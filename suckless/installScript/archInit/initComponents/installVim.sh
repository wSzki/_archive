#!/bin/sh

# Gruvbox & Airline  //////////////////////////////////////////////////////////////////////
mkdir -p ~/.vim/autoload ~/.vim/bundle && \
curl -LSso ~/.vim/autoload/pathogen.vim https://tpo.pe/pathogen.vim
git clone https://github.com/morhetz/gruvbox.git ~/.vim/bundle/gruvbox
git clone https://github.com/vim-airline/vim-airline ~/.vim/bundle/vim-airline

# Vim Notes ///////////////////////////////////////////////////////////////////////////////
cd ~/.vim/bundle/
wget http://peterodding.com/code/vim/downloads/notes.zip
wget http://peterodding.com/code/vim/downloads/misc.zip

unzip ./notes.zip -d vim-notes
unzip ./misc.zip -d vim-misc
rm ./notes.zip && rm ./misc.zip

# You Complete Me /////////////////////////////////////////////////////////////////////////
cd ~/.vim/bundle
git clone https://github.com/Valloric/YouCompleteMe.git
cd YouCompleteMe
git submodule update --init --recursive
./install.sh --clang-completer
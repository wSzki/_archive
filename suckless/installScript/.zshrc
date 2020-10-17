# If you come from bash you might have to change your $PATH.
# Path to your oh-my-zsh installation.

export ZSH="/home/wsz/.oh-my-zsh"
# Set name of the theme to load --- if set to "random", it will
# load a random theme each time oh-my-zsh is loaded, in which case,
# to know which specific one was loaded, run: echo $RANDOM_THEME
# See https://github.com/robbyrussell/oh-my-zsh/wiki/Themes
#ZSH_THEME="robbyrussell"
#ZSH_THEME="spaceship"
#ZSH_THEME="agnoster"
#source /usr/share/zsh-theme-powerlevel9k/powerlevel9k.zsh-theme
#source /usr/share/lambda-mod-zsh-theme/lambda-mod.zsh-theme
source /usr/share/geometry/geometry.zsh-theme

# Set list of themes to pick from when loading at random
# Setting this variable when ZSH_THEME=random will cause zsh to load
# a theme from this variable instead of looking in ~/.oh-my-zsh/themes/
# If set to an empty array, this variable will have no effect.
# ZSH_THEME_RANDOM_CANDIDATES=( "robbyrussell" "agnoster" )

# Uncomment the following line to use case-sensitive completion.
# CASE_SENSITIVE="true"

# Uncomment the following line to use hyphen-insensitive completion.
# Case-sensitive completion must be off. _ and - will be interchangeable.
# HYPHEN_INSENSITIVE="true"

# Uncomment the following line to disable bi-weekly auto-update checks.
# DISABLE_AUTO_UPDATE="true"

# Uncomment the following line to automatically update without prompting.
# DISABLE_UPDATE_PROMPT="true"

# Uncomment the following line to change how often to auto-update (in days).
# export UPDATE_ZSH_DAYS=13

# Uncomment the following line if pasting URLs and other text is messed up.
# DISABLE_MAGIC_FUNCTIONS=true

# Uncomment the following line to disable colors in ls.
# DISABLE_LS_COLORS="true"

# Uncomment the following line to disable auto-setting terminal title.
# DISABLE_AUTO_TITLE="true"

# Uncomment the following line to enable command auto-correction.
ENABLE_CORRECTION="true"

# Uncomment the following line to display red dots whilst waiting for completion.
COMPLETION_WAITING_DOTS="true"

# Uncomment the following line if you want to disable marking untracked files
# under VCS as dirty. This makes repository status check for large repositories
# much, much faster.
# DISABLE_UNTRACKED_FILES_DIRTY="true"

# Uncomment the following line if you want to change the command execution time
# stamp shown in the history command output.
# You can set one of the optional three formats:
# "mm/dd/yyyy"|"dd.mm.yyyy"|"yyyy-mm-dd"
# or set a custom format using the strftime function format specifications,
# see 'man strftime' for details.
#HIST_STAMPS="mm/dd/yyyy"

# Would you like to use another custom folder than $ZSH/custom?
# ZSH_CUSTOM=/path/to/new-custom-folder

# Which plugins would you like to load?
# Standard plugins can be found in ~/.oh-my-zsh/plugins/*
# Custom plugins may be added to ~/.oh-my-zsh/custom/plugins/
# Example format: plugins=(rails git textmate ruby lighthouse)
# Add wisely, as too many plugins slow down shell startup.
plugins=(git)

source $ZSH/oh-my-zsh.sh

# User configuration

# export MANPATH="/usr/local/man:$MANPATH"

# You may need to manually set your language environment
# export LANG=en_US.UTF-8

# Preferred editor for local and remote sessions
# if [[ -n $SSH_CONNECTION ]]; then
#   export EDITOR='vim'
# else
#   export EDITOR='mvim'
# fi

# Compilation flags
# export ARCHFLAGS="-arch x86_64"

# Set personal aliases, overriding those provided by oh-my-zsh libs,
# plugins, and themes. Aliases can be placed here, though oh-my-zsh
# users are encouraged to define aliases within the ZSH_CUSTOM folder.
# For a full list of active aliases, run `alias`.
#
# Example aliases
# alias zshconfig="mate ~/.zshrc"
# alias ohmyzsh="mate ~/.oh-my-zsh"

#NAV
alias cdv="cd ~/.vim"
alias vrc="vim ~/.vimrc"
alias zrc="vim ~/.zshrc"
alias cdd="cd ~/Desktop"
alias cddl="cd ~/Downloads"
alias cddo="cd ~/Documents"
alias cdt="cd /tmp"
alias cdsu="cd ~/Desktop/Suckless/"
alias cdw="cd ~/Desktop/Web"


alias weather="curl wttr.in"
alias f="fzf -e"
alias p="ping google.fr"
alias is="vim ~/Desktop/Suckless/installScript/installScript.sh"
alias t="task"
alias wifi="sudo wifi-menu"
alias veille="systemctl suspend"

alias ipinfo="ifconfig | grep \"inet \" | grep -v 127.0.0.1"
alias n="vim note:Notes"

#GIT
alias autopush="git add .; git status; git commit -m "autopush"; git push"

#ALIASLIST
alias aliaslist="cd; grep ^alias .zshrc; cd -"

#BACKUP
alias backuprc="cd; git add ~/.vimrc; git add ~/.zshrc; git add ~/.vim; git add ~/.lynxrc; git add ~/.links; git add ~/.chunkwmrc; git add ~/.oh-my-zsh; git add ~/.TerminalNotes.txt; git status ~/; git commit -m "Backup"; git push origin master; cd -"

alias backup="cd; cp /etc/X11/xorg.conf.d/40-touchpad.conf .zshrc .xinitrc .bg.png .xbindkeysrc .vimrc ~/Desktop/Suckless/rcfiles/; cdsu; autopush;"

#alias backupnotes="cd ~/NOTES; git add .; git status .; git commit -m "Backup"; git push origin master; cd -"


#alias dlynx="lynx duck.com"
alias duck="lynx duck.com"
#alias lynxlss="vim /usr/local/etc/lynx.lss"
alias reload="source ~/.zshrc"
#alias lynxrc="vim ~/.lynxrc"
#alias lynxcfg="vim /usr/local/Cellar/lynx/2.8.9rel.1/etc/lynx.cfg"


#alias n="vim ~/.vim/bundle/vim-notes/misc/notes/user/Notes"

#alias slowdown="xinput --set-prop 12'libinput Accel Speed' -1;xinput --list-props 12"
#alias slowmouse="xinput --set-prop 14'libinput Accel Speed' -1;xinput --list-props 14"

#alias shinedown="xbacklight -set 60; xgamma -gamma 0.8;"
#alias red="redshift -P -O 3000"

#alias bright="xrandr --output eDP1 --brightness 1"
#alias battery="cat /sys/class/power_supply/BAT0/capacity;cat /sys/class/power_supply/BAT1/capacity"

#alias notes="vim ~/Notes/notes"
#alias snotes="vim ~/notes/snotes"
#alias music="vim ~/Notes/music"
#alias reminotes="vim ~/Notes/reminotes"
#alias todo="vim ~/notes/todo"
#alias bind="vim ~/notes/bind"
#alias lookingood="xbacklight -set 60; xgamma -gamma 0.8;redshift -P -O 3000"
#alias open="xdg-open .;"


#alias piano="cd /home/wsz/Applications/Pianoteq\ 6/amd64/;./Pianoteq\ 6;cd -"
#alias orca="cd /home/wsz/Applications/Orca/desktop/;npm start;cd -"

#alias left="cd /home/wsz/Applications/Left/desktop/;npm start;cd -"
#alias knots="vim ~/simplon/.knots"

#alias cds="cd ~/Simplon"
#alias cdsjs="cd ~/Simplon/JS"
#alias cdshtml="cd ~/Simplon/HTML_CSS"


#alias cdme="cd ~/Music/Elliot"
#alias cdm="cd ~/Music/"
#alias cdsu="cd ~/Desktop/Suckless/"

#alias chromium="chromium --app=\"http://quora.com\""

#alias touchpad="sudo modprobe -r psmouse && sudo modprobe psmouse"

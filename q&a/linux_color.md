vim ~/.bashrc
///
export PS1='$? \[\033[01;31m\]\h\[\033[01;34m\] \W \$\[\033[00m\] '
export TERM=linux
umask 022

export LS_OPTIONS='--color=auto -h'
eval "`dircolors`"
alias l='ls $LS_OPTIONS -lA'
alias empty='cat /dev/null >'

alias prep='grep -P'
///

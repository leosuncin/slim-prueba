FROM gitpod/workspace-mysql:latest

USER root

RUN apt-get update &&\
    apt-get install -y silversearcher-ag &&\
    pip install httpie mycli &&\
    apt-get clean &&\
    rm -rf /var/cache/apt/* &&\
    rm -rf /var/lib/apt/lists/* &&\
    rm -rf /tmp/*

USER gitpod

RUN git config --global alias.last "log -1 --stat" &&\
	git config --global alias.pick cherry-pick &&\
	git config --global alias.co checkout &&\
    git config --global alias.cl clone &&\
    git config --global alias.ci commit &&\
    git config --global alias.st "status -sb" &&\
    git config --global alias.br "branch --format='%(HEAD) %(color:yellow)%(refname:short)%(color:reset) - %(contents:subject) %(color:green)(%(committerdate:relative)) [%(authorname)]' --sort=-committerdate" &&\
    git config --global alias.unstage "reset HEAD --" &&\
    git config --global alias.unchanged "update-index --assume-unchanged" &&\
    git config --global alias.changed "update-index --no-assume-unchanged" &&\
    git config --global alias.dc "diff --cached" &&\
    git config --global alias.dfs "!git diff --color --staged | diff-so-fancy | less --tabs=1,5 -RFX" &&\
    git config --global alias.lg "log --graph --pretty=format:'%Cred%h%Creset -%C(yellow)%d%Creset %s %Cgreen(%cr) %Cblue<%an>%Creset' --abbrev-commit --date=relative --all" &&\
    git config --global alias.a "add --all" &&\
    git config --global alias.amend "commit --amend" &&\
    git config --global alias.fixup "commit --fixup" &&\
    git config --global alias.leaderboard "shortlog -sn" &&\
    git config --global alias.recent "for-each-ref --count=10 --sort=-committerdate refs/heads/ --format='%(refname:short)'" &&\
    git config --global alias.overview "log --all --oneline --no-merges" &&\
    git config --global alias.undo "reset HEAD~1 --mixed" &&\
    git config --global push.default current &&\
    git config --global help.autocorrect true &&\
    git config --global pull.rebase true &&\
    git config --global rerere.enabled true &&\
    git config --global rebase.autoStash true &&\
    git config --global remote.pushdefault origin

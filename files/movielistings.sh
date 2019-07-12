#!/bin/sh
echo "Doing preliminary work..."
# Declaring working and target folders
movfol="/cygdrive/d/Videos/Movies"
serfol="/cygdrive/d/Videos/Series"
quefol="/cygdrive/d/Videos/Queue"
docfol="/cygdrive/d/Videos/Documentaires"
workfol="/cygdrive/d/Dropbox/Various/Movie_Listing/"
# Declaring the filenamestuff
genday=$(date +"%Y-%m-%d")  # 2014-12-31
movlist=$workfol"movielist--"$genday".txt" # Movie_Listing/movielist--2014-12-31.txt
serlist=$workfol"serieslist--"$genday".txt"
quelist=$workfol"queuelist--"$genday".txt"
doclist=$workfol"docslist--"$genday".txt"
# Declaring pause function
function pause(){
   read -p "$*"
}
# Actual work
echo "Building directory trees..."
echo ""
echo -e "List of movies found on "$genday".\n-----------------------------------" > $movlist
du -h $movfol | tail -1 >> $movlist
tree -d $movfol >> $movlist
echo "Found" $(cat $movlist | grep directories)  "in the folder movies."
echo -e "List of folders of series found on "$genday".\n----------------------------------------------" > $serlist
du -h $serfol | tail -1 >> $serlist
tree -d $serfol >> $serlist
echo "Found" $(cat $serlist | grep directories)  "in the folder series."
echo -e "List of movies found in the queue on "$genday".\n------------------------------------------------" > $quelist
du -h $quefol | tail -1 >> $quelist
tree -d $quefol >> $quelist
echo "Found" $(cat $quelist | grep directories)  "in the queue."
echo -e "List of documentaries found on "$genday".\n------------------------------------------" > $doclist
du -h $docfol | tail -1 >> $doclist
tree $docfol >> $doclist
echo "Found" $(cat $doclist | grep directories)  "in the folder documentaries."
echo ""
echo "-----------------------------------------------------------------------"
echo "All files have been created."
echo ""
echo "They can be found in the Movie Listing folder under Various in Dropbox:"
echo "Windows:	D:/Dropbox/Various/Movie_Listing/"
echo "Linux:		/cygdrive/d/dropbox/various/movie_listing/"
echo ""
echo "The total size of your video folders are:"
du -h Videos/ | sort -h | tail -4
echo "-----------------------------------------------------------------------"
echo ""
echo "Created files:"
ls $workfol | grep "$(date '+%Y-%m-%d')"
echo ""
while true; do
	read -e -p "Do you wish to view the files? Yes/No: " yn
	case $yn in
		[Yy]* ) echo "Use ':n' and ':p' to go to next/previous file. 'k' and 'j' scroll up/down. 'q' quits" ; pause "Press [ENTER] to continue" ; less $movlist $serlist $quelist $doclist; echo "" ; exit ;;
		[Nn]* ) echo "" ; exit;;
		* ) echo "Please answer yes or no.";;
	esac  
done

#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/core/core.hpp>
#include <opencv2/imgcodecs/imgcodecs.hpp>
#include <opencv2/imgproc.hpp>
#include <opencv2/videoio.hpp>
#include <opencv2/highgui.hpp>
#include <opencv2/video.hpp>
#include <cv.hpp>
#include <opencv2/video/background_segm.hpp>

#include <iostream>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard;   //input from keyboard

Ptr<BackgroundSubtractorMOG2> pMOG2;
void processImages(int, void*);

int main()
{
	pMOG2 = createBackgroundSubtractorMOG2();
	processImages(0,0);

	destroyAllWindows();
	return EXIT_SUCCESS;
}

void processImages(int, void*) {

	string path = "/Users/will/Desktop/DATA/IMG_0001.JPG";
	string prefix = "IMG_0";
	string suffix = ".JPG";
	prefix = path + prefix;
	int index = 0;

	//read input data. ESC or 'q' for quitting
	namedWindow("Images", CV_WINDOW_AUTOSIZE);
	while (index < 1) {

		index++;
		/*string name = prefix;
		int n = 0;
		for (int i = index; i > 9; i /= 10)
			n++;

		for (int i = 0; i < 2 - n; i++) {
			name = name + '0';
		}	*/
        
        
        string name = "/Users/will/Desktop/DATA/IMG_0004.JPG";
        
        curFrame = imread(name);
        Mat bgr[3];
        split(curFrame,bgr);//split source
        
        Mat diff = bgr[0] != bgr[1];
        
        //is it a color image, threshold 0
        bool eq = ((518400 - countNonZero(diff==0)) > 0);
        cout << eq << endl;

		imshow("Backgound", diff);
		keyboard = waitKey(100);
	}
	while (1);
}
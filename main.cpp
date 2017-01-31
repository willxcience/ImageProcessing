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
#include <Windows.h>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard;   //input from keyboard

Ptr<BackgroundSubtractor> pMOG2;
void processImages();

int main()
{



	pMOG2 = createBackgroundSubtractorKNN();
	processImages();

	/*
	VideoCapture cap(0);
	if (!cap.isOpened())
	{
		return -1;
	}

	//create a background object
	pMOG2 = createBackgroundSubtractorKNN();

	bool stop = false;
	int i = 0;
	while (!stop) {
		cap >> curFrame;

		Mat res;
		Mat fgMaskMOG2;

		//flip the currentFrame
		flip(curFrame, curFrame, 1);


		pMOG2->apply(curFrame, fgMaskMOG2);

		if (i > 0) {
			imshow("Camera", curFrame);
			imshow("Backgound", fgMaskMOG2);

		}
		i++;
		char c = waitKey(10);
		if (c == 'q' && c == 27) break;
	}


	cap.release()

	*/
	destroyAllWindows();
	return EXIT_SUCCESS;
}


void processImages() {

	string path = "C:\\Users\\Will\\Documents\\ImageProcessing\\DATA\\Woodpile road\\";
	string prefix = "IMG_0";
	string suffix = ".JPG";
	prefix = path + prefix;
	int index = 0;

	//read input data. ESC or 'q' for quitting
	namedWindow("Images", CV_WINDOW_AUTOSIZE);
	while (index < 529) {

		index++;
		string name = prefix;
		int n = 0;
		for (int i = index; i > 9; i /= 10)
			n++;

		cout << n << endl;

		for (int i = 0; i < 2 - n; i++) {
			name = name + '0';
		}
		
		name = name + to_string(index) + suffix;
		curFrame = imread(name);
		Mat mine;
		resize(curFrame, mine, Size(960, 540), (0, 0), (0, 0), cv::INTER_LINEAR);
		Mat fMog2;
		pMOG2->apply(mine, fMog2);
		imshow("Images", mine);
		imshow("Backgound", fMog2);
		Sleep(10);
		waitKey(10);
	}
	while (1);
}
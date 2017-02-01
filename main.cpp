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

Ptr<BackgroundSubtractorMOG2> pMOG2;
void processImages(int, void*);

int const max_elem = 2;
int const max_kernel_size = 21;
int open_elem = 0;
int open_size = 0;

int main()
{



	pMOG2 = createBackgroundSubtractorMOG2();
	processImages(0,0);

	createTrackbar("Element:\n 0: Rect \n 1: Cross \n 2: Ellipse", "Dilation Demo",
		&open_elem, max_elem,
		processImages);

	createTrackbar("Kernel size:\n 2n +1", "Dilation Demo",
		&open_size, max_kernel_size,
		processImages);
	
	destroyAllWindows();
	return EXIT_SUCCESS;
}

void processImages(int, void*) {

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

		for (int i = 0; i < 2 - n; i++) {
			name = name + '0';
		}	
		name = name + to_string(index) + suffix;

		//cout << name << endl;
		pMOG2->setHistory(3);
		cout << "history: " << pMOG2->getHistory() << endl;
		curFrame = imread(name);
		Mat mine;
		resize(curFrame, mine, Size(960, 540), (0, 0), (0, 0), cv::INTER_LINEAR);
		Mat fMog2;
		pMOG2->apply(mine, fMog2);
		imshow("Images", mine);
		Mat element = getStructuringElement(MORPH_RECT,Size(2*open_size+1,2*open_size+1));

		morphologyEx(fMog2, fMog2, MORPH_CLOSE, element);

		imshow("Backgound", fMog2);
		Sleep(50);
		waitKey(10);
	}
	while (1);
}
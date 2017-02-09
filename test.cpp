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
//#include <Windows.h>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard = 0;   //input from keyboard

void processImages();
string generateFileName(int index);
bool checkGrayscale(Mat src);

int main()
{
	processImages();

	destroyAllWindows();
	return EXIT_SUCCESS;
}

void processImages()
{
	namedWindow("Original", CV_WINDOW_NORMAL);
	namedWindow("Motion", CV_WINDOW_NORMAL);

	string fileName;
	Mat frames[3];
	Mat motion;
	Mat motion2;
    
	int index = 1;
	while (index < 530 && (char)keyboard != 'q' && (char)keyboard != 27)
	{
        int pixels = 0;
		fileName = generateFileName(index);
        //cout << fileName << endl;
		curFrame = imread(fileName);
		resize(curFrame, curFrame, Size(960, 540));
        
		//update the buffer
		int currIndex = (index - 1) % 3;
		frames[currIndex] = curFrame;

		if (currIndex == 2)
		{
			absdiff(frames[0], frames[1], motion);
			absdiff(frames[1], frames[2], motion2);
			absdiff(motion, motion2, motion);
			threshold(motion, motion, 15, 255, THRESH_BINARY);

			//Morphology OPEN & CLOSE
			morphologyEx(motion, motion, MORPH_OPEN, getStructuringElement(MORPH_RECT, Size(15, 15)));
			morphologyEx(motion, motion, MORPH_CLOSE, getStructuringElement(MORPH_CROSS, Size(10, 10)));
		}

		imshow("Original", curFrame);

        if (index > 2)
        {
            Mat tmp;
            cvtColor(motion, tmp, cv::COLOR_RGB2GRAY);
			imshow("Motion", motion);
            
            pixels = countNonZero(tmp==0);
            pixels = 518400 - pixels;
        }
        
        /*threshold
        if (pixels > 0)
            cout << fileName << "    " << pixels << endl;*/
        
        
        checkGrayscale(curFrame);
        
		index++;
		keyboard = waitKey(50);
	}

	while ((char)keyboard != 'q' && (char)keyboard != 27)
		keyboard = waitKey(0);
}

string generateFileName(int index = 1)
{
	const string path = "/Users/will/Desktop/DATA/";
	const string prefix = "IMG_";
	const string suffix = ".JPG";
	string name = path + prefix;

	int n = 0;
	for (int i = index; i > 9; i /= 10)
		n++;

	for (int i = 0; i < 3 - n; i++)
		name = name + '0';

	name = name + to_string(index) + suffix;

	return name;
}

int countPixels(Mat a)
{
    return countNonZero(a);
}


bool checkGrayscale(Mat src)
{
    Mat bgr[3];
    split(src,bgr);//split source
    
    cv::Mat diff = bgr[0] != bgr[1];
    bool eq = cv::countNonZero(diff) == 0;
    cout << eq << endl;
    return eq;
}
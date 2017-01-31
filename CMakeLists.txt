# cmake needs this line
cmake_minimum_required(VERSION 2.8)

# Define project name
project(TEST)

find_package(OpenCV REQUIRED)

# Print some message showing some of them
message(STATUS "OpenCV library status:")
message(STATUS "    version: ${OpenCV_VERSION}")
message(STATUS "    include path: ${OpenCV_INCLUDE_DIRS}")

include_directories(${OpenCV_INCLUDE_DIRS})

#Declare the executable
add_executable(test main.cpp)

#Libraries
target_link_libraries(test ${OpenCV_LIBS})

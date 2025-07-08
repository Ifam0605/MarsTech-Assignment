#include <stdio.h>
#include <math.h>

// Function to decompose a number into digits and display position values
void decomposeNumber(int num) {
    int position = 1;  // Start with the least significant position (1s)

    if (num <= 0) {
        printf("Error: Please enter a positive number.\n");
        return;
    }

    printf("Decomposition of %d:\n", num);

    while (num > 0) {
        int digit = num % 10;  // Extract the last digit
        printf("No. of %ds = %d\n", position, digit);
        num /= 10;             // Remove the last digit
        position *= 10;        // Move to the next position (10s, 100s, etc.)
    }
}

int main() {
    int number;
    printf("Enter a positive number: ");
    scanf("%d", &number);

    // Call the function to decompose the number
    decomposeNumber(number);

    return 0;
}

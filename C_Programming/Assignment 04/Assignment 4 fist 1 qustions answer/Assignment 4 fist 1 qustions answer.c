#include <stdio.h>

// Function to display the multiplication table
void displayTable(int num) {
    if (num <= 1) {
        printf("Error: Input number should be greater than 1.\n");
        return;
    }

    for (int i = 1; i <= 15; i++) {
        printf("%d x %d = %d\n", i, num, i * num);
    }
}

int main() {
    int number;
    printf("Enter a number greater than 1: ");
    scanf("%d", &number);

    // Call the function to display the table
    displayTable(number);

    return 0;
}

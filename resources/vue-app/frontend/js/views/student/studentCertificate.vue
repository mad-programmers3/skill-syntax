<template>
    <div class="certificate-container">
        <h1 class="text-center">Skill Syntax Course Certificate Management</h1>
        <form @submit.prevent="submitCertificate" class="certificate-form">
            <div class="form-group">
                <label for="studentName">Your Name:</label>
                <input
                        type="text"
                        id="studentName"
                        v-model="formData.name"
                        required
                        placeholder="Enter your name"
                        class="form-control"
                />
            </div>
            <div class="form-group">
                <label for="courseTitle">Course Title:</label>
                <select
                        id="courseTitle"
                        v-model="formData.courseId"
                        required
                        class="form-control"
                >
                    <option disabled value="">Select a course</option>
                    <option v-for="course in courses" :key="course.id" :value="course.id">
                        {{ course.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Completion Date:</label>
                <input
                        type="date"
                        id="date"
                        v-model="formData.completionDate"
                        required
                        class="form-control"
                />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Generate Certificate</button>
        </form>

        <div v-if="certificateVisible" class="certificate">
            <h2 class="certificate-title">Certificate of Completion</h2>
            <p>This certifies that <strong>{{ formData.name }}</strong> has completed the course <strong>{{ getCourseTitle(formData.courseId) }}</strong>.</p>
            <p>Completion Date: {{ formatDate(formData.completionDate) }}</p>
            <div class="certificate-footer">
                <p>Issued on: {{ formatDate(new Date()) }}</p>
            </div>
            <button class="btn btn-success" @click="downloadCertificate">Download Certificate</button>
        </div>
    </div>
</template>

<script>
    import jsPDF from 'jspdf';

    export default {
        name: "StudentCertificate",
        data() {
            return {

                courses: [
                    { id: 1, title: "Web Development Course" },
                    { id: 2, title: "Full-Stack Development Course" },
                    { id: 3, title: "Mobile App Development Course" },
                    { id: 4, title: "Graphic Design" },
                    { id: 5, title: "AI and Machine Learning Course" }
                ],
                certificateVisible: false
            };
        },
        created() {
            this.fetchCourses();
        },
        methods: {
            async fetchCourses() {
                try {
                    // Uncomment below if you want to fetch from an API
                    // const response = await axios.get('/api/courses');
                    // this.courses = response.data;
                    // For now, using hardcoded courses
                } catch (error) {
                    console.error("Error fetching courses:", error);
                }
            },
            submitCertificate() {
                this.certificateVisible = true;
                // Optionally, save to database using an API call here
            },
            getCourseTitle(courseId) {
                const course = this.courses.find(c => c.id === courseId);
                return course ? course.title : '';
            },
            formatDate(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(date).toLocaleDateString(undefined, options);
            },downloadCertificate() {
                const doc = new jsPDF('landscape', 'mm', 'a4'); // Landscape orientation

                // Background color
                doc.setFillColor(240, 240, 240); // Light gray background
                doc.rect(0, 0, doc.internal.pageSize.width, doc.internal.pageSize.height, 'F');

                // Outer Border (Info Color)
                const outerBorderWidth = 1;
                doc.setLineWidth(outerBorderWidth);
                doc.setDrawColor(0, 123, 255); // Info color (Bootstrap primary)
                doc.rect(outerBorderWidth, outerBorderWidth, doc.internal.pageSize.width - (outerBorderWidth * 2), doc.internal.pageSize.height - (outerBorderWidth * 2));

                // Inner Border (#002347)
                const innerBorderWidth = 10;
                doc.setLineWidth(1); // 1px thickness
                doc.setDrawColor(0, 35, 71); // #002347 in RGB
                doc.roundedRect(innerBorderWidth, innerBorderWidth, doc.internal.pageSize.width - (innerBorderWidth * 2), doc.internal.pageSize.height - (innerBorderWidth * 2), 10, 10);

                // Title
                doc.setFont('Helvetica', 'bold');
                doc.setFontSize(36);
                doc.setTextColor(0, 51, 153); // Dark blue color
                doc.text('CERTIFICATE OF COMPLETION', doc.internal.pageSize.width / 2, 50, { align: 'center' });

                // Subtitle
                doc.setFontSize(20);
                doc.setFont('Helvetica', 'normal');
                doc.setTextColor(0, 0, 0); // Black color
                doc.text('This certificate is awarded to', doc.internal.pageSize.width / 2, 80, { align: 'center' });

                // Student Name
                doc.setFontSize(28);
                doc.setFont('Georgia', 'italic'); // Cursive-like font
                doc.text(this.formData.name || 'Name', doc.internal.pageSize.width / 2, 110, { align: 'center' });

                // Horizontal Line for Course Title
                doc.setDrawColor(0, 51, 153); // Blue color
                doc.setLineWidth(1);
                doc.line(40, 130, doc.internal.pageSize.width - 40, 130); // Horizontal line

                // Course Title
                doc.setFontSize(20);
                doc.setFont('Helvetica', 'bold');
                doc.text('For successfully completing:', doc.internal.pageSize.width / 2, 140, { align: 'center' });

                // Course title in a separate line
                doc.setFontSize(22);
                doc.setFont('Georgia', 'bold'); // Cursive-like font
                doc.text(this.getCourseTitle(this.formData.courseId) || 'Course Title', doc.internal.pageSize.width / 2, 170, { align: 'center' });

                // Body text
                doc.setFontSize(14);
                doc.setFont('Helvetica', 'normal');
                doc.text('', doc.internal.pageSize.width / 2, 210, { align: 'center', maxWidth: 190 });

                // Completion Date
                doc.setFontSize(12);
                doc.text(`Completion Date: ${this.formatDate(this.formData.completionDate)}`, 30, doc.internal.pageSize.height - 60);

                // Horizontal Line for Signature
                doc.setDrawColor(0, 0, 0); // Black color
                doc.setLineWidth(1);
                doc.line(30, doc.internal.pageSize.height - 50, 120, doc.internal.pageSize.height - 50); // Left signature line

                // Set font for signature text to normal
                doc.setFont('Helvetica', 'normal'); // Change to normal
                doc.text('CSE Engineer Signature', 30, doc.internal.pageSize.height - 45); // Left Signature Text

                // Horizontal Line for Head Sir Signature
                doc.line(doc.internal.pageSize.width - 120, doc.internal.pageSize.height - 50, doc.internal.pageSize.width - 30, doc.internal.pageSize.height - 50); // Right signature line
                doc.text('Head Sir Signature', doc.internal.pageSize.width - 120, doc.internal.pageSize.height - 45); // Right Signature Text

                // Add 30-word Lorem Ipsum text
                doc.setFontSize(12);
                const loremText = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
                doc.text(loremText, 30, doc.internal.pageSize.height - 90, { maxWidth: doc.internal.pageSize.width - 60 }); // Add Lorem Ipsum text

                // Save the PDF
                doc.save(`${this.formData.name}_Certificate.pdf`);
            }

        }
    }
</script>

<style scoped>
    .certificate-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .text-center {
        text-align: center;
    }

    .certificate-form {
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn {
        padding: 10px;
        border-radius: 5px;
    }

    .btn-block {
        width: 100%;
    }

    .certificate {
        margin-top: 20px;
        padding: 20px;
        border: 2px solid #007bff;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .certificate-title {
        text-align: center;
        font-size: 24px;
        color: #007bff;
        margin-bottom: 20px;
    }

    .certificate-footer {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
        text-align: right;
    }
</style>
